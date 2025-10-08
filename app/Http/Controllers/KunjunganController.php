<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Obat;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;

class KunjunganController extends Controller
{
    /**
     * Tampilkan daftar kunjungan.
     */
    public function index(Request $request)
    {
       $user = Auth::user();

        if ($user->role === 'siswa' && $user->nis) {
            $riwayat = Kunjungan::where('nis', $user->nis)->get();
        } else {
            // jika bukan siswa valid, tidak bisa lihat apa pun
            $riwayat = collect(); 
        }

        return view('siswa.riwayat', compact('riwayat'));
    }

    /**
     * Form tambah kunjungan.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $obat  = Obat::all();

        return view('kunjungan.create', compact('siswa', 'obat'));
    }

    /**
     * Simpan data kunjungan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis'              => 'required|exists:siswa,nis',
            'waktu_kedatangan' => 'required|date',
            'waktu_keluar'     => 'nullable|date|after_or_equal:waktu_kedatangan',
            'keluhan'          => 'nullable|string',
            'obat_id'          => 'nullable|exists:obat,id',
            'diagnosis' => 'required|string|max:255',

        ]);

        $siswa = Siswa::where('nis', $validated['nis'])->firstOrFail();

        Kunjungan::create([
            'nis'              => $siswa->nis,
            'nama'             => $siswa->nama,
            'kelas'            => $siswa->kelas,
            'jurusan'          => $siswa->jurusan,
            'waktu_kedatangan' => $validated['waktu_kedatangan'],
            'waktu_keluar'     => $validated['waktu_keluar'] ?? null,
            'keluhan'          => $validated['keluhan'] ?? null,
            'obat_id'          => $validated['obat_id'] ?? null,
            'diagnosis' => $validated['diagnosis'],
        ]);

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil ditambahkan.');

        $kunjunganCount = Kunjungan::where('nis', $siswa->nis)
    ->whereBetween('waktu_kedatangan', [now()->startOfWeek(), now()->endOfWeek()])
    ->count();

if ($kunjunganCount >= 3) {
    // Simpan notifikasi sederhana (atau tampilkan alert di view)
    session()->flash('warning', '⚠️ Siswa ini sudah sering sakit minggu ini. Perlu rujukan lebih lanjut.');
}

    }

    /**
     * Tampilkan detail kunjungan.
     */
    public function show(Kunjungan $kunjungan)
    {
        return view('kunjungan.show', compact('kunjungan'));
    }

    /**
     * Form edit kunjungan.
     */
    public function edit(Kunjungan $kunjungan)
    {
        $siswa = Siswa::all();
        $obat  = Obat::all();

        return view('kunjungan.edit', compact('kunjungan', 'siswa', 'obat'));
    }

    /**
     * Update data kunjungan.
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'nis'              => 'required|exists:siswa,nis',
            'waktu_kedatangan' => 'required|date',
            'waktu_keluar'     => 'nullable|date|after_or_equal:waktu_kedatangan',
            'keluhan'          => 'nullable|string',
            'obat_id'          => 'nullable|exists:obat,id',
        ]);

        $siswa = Siswa::where('nis', $validated['nis'])->firstOrFail();

        $kunjungan->update([
            'nis'              => $siswa->nis,
            'nama'             => $siswa->nama,
            'kelas'            => $siswa->kelas,
            'jurusan'          => $siswa->jurusan,
            'waktu_kedatangan' => $validated['waktu_kedatangan'],
            'waktu_keluar'     => $validated['waktu_keluar'] ?? null,
            'keluhan'          => $validated['keluhan'] ?? null,
            'obat_id'          => $validated['obat_id'] ?? null,
        ]);

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil diperbarui.');
    }

    /**
     * Hapus data kunjungan.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil dihapus.');
    }

    /**
     * Ekspor data ke CSV.
     */
    public function exportCsv()
    {
        $fileName  = 'kunjungan_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $kunjungan = Kunjungan::with('obat')->get();

        $headers = [
            "Content-Type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];

        $columns = [
            'ID', 'NIS', 'Nama Siswa', 'Kelas', 'Jurusan',
            'Waktu Kedatangan', 'Waktu Keluar', 'Keluhan', 'Obat'
        ];

        $callback = function () use ($kunjungan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($kunjungan as $k) {
                fputcsv($file, [
                    $k->id,
                    $k->nis,
                    $k->nama,
                    $k->kelas,
                    $k->jurusan,
                    $k->waktu_kedatangan,
                    $k->waktu_keluar ?? '-',
                    $k->keluhan ?? '-',
                    optional($k->obat)->nama ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function laporan(Request $request)
{
    $filter = $request->get('filter', 'mingguan');

    $data = match ($filter) {
        'mingguan' => Kunjungan::selectRaw('YEARWEEK(waktu_kedatangan, 1) as periode, COUNT(*) as total')
                        ->groupBy('periode')
                        ->orderBy('periode', 'desc')
                        ->take(10)
                        ->get(),
        'bulanan'  => Kunjungan::selectRaw('DATE_FORMAT(waktu_kedatangan, "%Y-%m") as periode, COUNT(*) as total')
                        ->groupBy('periode')
                        ->orderBy('periode', 'desc')
                        ->take(12)
                        ->get(),
        'tahunan'  => Kunjungan::selectRaw('YEAR(waktu_kedatangan) as periode, COUNT(*) as total')
                        ->groupBy('periode')
                        ->orderBy('periode', 'desc')
                        ->take(5)
                        ->get(),
        default    => collect(),
    };

    return view('kunjungan.laporan', compact('data', 'filter'));
}

}
