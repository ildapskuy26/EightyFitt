<?php

namespace App\Http\Controllers;

use App\Models\Pembukuan;
use App\Models\Kunjungan;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

class PembukuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembukuan::query();

        // Filter Jenis Periode
        if ($request->filled('jenis_periode') && $request->jenis_periode !== 'semua') {
            $query->where('jenis_periode', $request->jenis_periode);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('periode', $request->tahun);
        }

        // Filter Bulan (jika jenis_periode = bulanan)
        if ($request->filled('bulan') && $request->bulan != '') {
            $query->whereMonth('periode', $request->bulan);
        }

        // Filter pencarian judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $pembukuans = $query->orderBy('periode', 'desc')->paginate(10);

        // Untuk dropdown tahun dinamis
        $tahunSekarang = now()->year;
        $tahunAwal = 2020;
        $tahunList = range($tahunAwal, $tahunSekarang);

        // Untuk dropdown bulan
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('pembukuan.index', compact('pembukuans', 'tahunList', 'bulanList'));
    }

    public function create()
    {
        return view('pembukuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_periode' => 'required|in:bulanan,tahunan',
            'bulan' => 'required_if:jenis_periode,bulanan|integer|between:1,12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1)
        ]);

        // Generate periode Carbon
        if ($request->jenis_periode == 'bulanan') {
            $periode = Carbon::create($request->tahun, $request->bulan, 1);
            $startDate = $periode->copy()->startOfMonth();
            $endDate = $periode->copy()->endOfMonth();
            $judul = "Laporan Bulanan {$periode->translatedFormat('F Y')}";
        } else {
            $periode = Carbon::create($request->tahun, 1, 1);
            $startDate = $periode->copy()->startOfYear();
            $endDate = $periode->copy()->endOfYear();
            $judul = "Laporan Tahunan {$request->tahun}";
        }

        // Ambil data kunjungan berdasarkan waktu_kedatangan
        $kunjungan = Kunjungan::whereBetween('waktu_kedatangan', [$startDate, $endDate])->get();
        $totalKunjungan = $kunjungan->count();

        // Ambil data obat
        $obat = Obat::all();
        $totalObat = $obat->count();
        $obatHampirHabis = $obat->where('stock', '<', 10)->count();

        // Hitung obat terdistribusi (jika ada field distributed)
        $obatTerdistribusi = $obat->sum('distributed') ?? 0;

        // Hitung ringkasan kunjungan
        $daysInPeriod = $request->jenis_periode == 'bulanan' ? $periode->daysInMonth : 365;
        $ringkasanKunjungan = [
            'total' => $totalKunjungan,
            'periode' => $request->jenis_periode == 'bulanan' 
                ? $periode->translatedFormat('F Y') 
                : "Tahun {$request->tahun}",
            'rata_rata_perhari' => $totalKunjungan > 0 
                ? round($totalKunjungan / $daysInPeriod, 2)
                : 0
        ];

        // Ringkasan obat
        $ringkasanObat = [
            'total_obat' => $totalObat,
            'obat_hampir_habis' => $obatHampirHabis,
            'obat_terdistribusi' => $obatTerdistribusi,
            'persentase_hampir_habis' => $totalObat > 0 
                ? round(($obatHampirHabis / $totalObat) * 100, 2)
                : 0
        ];

        // Simpan pembukuan
        $pembukuan = Pembukuan::create([
            'judul' => $request->judul ?: $judul,
            'periode' => $periode,
            'jenis_periode' => $request->jenis_periode,
            'total_kunjungan' => $totalKunjungan,
            'total_obat' => $totalObat,
            'obat_hampir_habis' => $obatHampirHabis,
            'obat_terdistribusi' => $obatTerdistribusi,
            'ringkasan_kunjungan' => $ringkasanKunjungan,
            'ringkasan_obat' => $ringkasanObat
        ]);

        return redirect()->route('pembukuan.show', $pembukuan->id)
            ->with('success', 'Laporan pembukuan berhasil dibuat!');
    }

    public function show(Pembukuan $pembukuan)
    {
        return view('pembukuan.show', compact('pembukuan'));
    }

    public function destroy(Pembukuan $pembukuan)
    {
        $pembukuan->delete();
        
        return redirect()->route('pembukuan.index')
            ->with('success', 'Laporan pembukuan berhasil dihapus!');
    }

    // Export Excel
    public function export($id)
    {
        // Ambil laporan pembukuan
        $pembukuan = Pembukuan::findOrFail($id);

        // Ambil data kunjungan sesuai periode laporan ini
        $bulan = $pembukuan->periode->format('m');
        $tahun = $pembukuan->periode->format('Y');

        $kunjungan = Kunjungan::whereMonth('waktu_kedatangan', $bulan)
            ->whereYear('waktu_kedatangan', $tahun)
            ->orderBy('waktu_kedatangan')
            ->get();

        // Buat spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Pembukuan-$bulan-$tahun");

        // Header kolom
        $sheet->setCellValue('A1', 'Minggu');
        $sheet->setCellValue('B1', 'NIS');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Jurusan');
        $sheet->setCellValue('F1', 'Waktu Kedatangan');
        $sheet->setCellValue('G1', 'Waktu Keluar');
        $sheet->setCellValue('H1', 'Keluhan');
        $sheet->setCellValue('I1', 'Obat');

        // Isi data
        $row = 2;
        foreach ($kunjungan as $k) {
            $mingguKe = ceil(Carbon::parse($k->waktu_kedatangan)->day / 7);

            $sheet->setCellValue("A{$row}", "Minggu ke-{$mingguKe}");
            $sheet->setCellValue("B{$row}", $k->nis);
            $sheet->setCellValue("C{$row}", $k->nama);
            $sheet->setCellValue("D{$row}", $k->kelas);
            $sheet->setCellValue("E{$row}", $k->jurusan);
            $sheet->setCellValue("F{$row}", $k->waktu_kedatangan);
            $sheet->setCellValue("G{$row}", $k->waktu_keluar);
            $sheet->setCellValue("H{$row}", $k->keluhan);
            $sheet->setCellValue("I{$row}", $k->obat->nama ?? '-');
            $row++;
        }

        // Simpan ke file download
        $writer = new Xlsx($spreadsheet);
        $filename = "Laporan-UKS-{$bulan}-{$tahun}.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
}
}
