<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Kunjungan;
use App\Models\Siswa;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class AdminController extends Controller
{
    public function dashboard()
    {
        $obat = Obat::select('nama', 'stock')->get();
        $kunjungan = Kunjungan::selectRaw('MONTH(waktu_kedatangan) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->orderBy('bulan')->get();

        return view('admin.dashboard', compact('obat', 'kunjungan'));
    }

    public function importSiswa(Request $request)
{
    $request->validate([
        'files' => 'required',
        'files.*' => 'mimes:xlsx,xls,csv'
    ]);

    ini_set('max_execution_time', 600); // 10 menit
    ini_set('memory_limit', '1024M');   // 1GB RAM

    try {
        DB::beginTransaction();
        $totalImported = 0;

        foreach ($request->file('files') as $file) {
            $extension = strtolower($file->getClientOriginalExtension());
            $path = $file->getRealPath();

            // === CSV lebih ringan ===
            if ($extension === 'csv') {
                $reader = new Csv();
                $reader->setInputEncoding('UTF-8');
                $reader->setDelimiter(',');
            } 
            // === XLSX & XLS pakai readDataOnly biar cepat ===
            elseif ($extension === 'xlsx') {
                $reader = new Xlsx();
                $reader->setReadDataOnly(true);
            } 
            else {
                $reader = new Xls();
                $reader->setReadDataOnly(true);
            }

            $spreadsheet = $reader->load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            $chunkSize = 500; // proses per 500 baris

            for ($startRow = 2; $startRow <= $highestRow; $startRow += $chunkSize) {
                $endRow = min($startRow + $chunkSize - 1, $highestRow);
                $rows = $sheet->rangeToArray("A{$startRow}:D{$endRow}", null, true, true, true);

                foreach ($rows as $row) {
                    $nis = trim($row['A'] ?? '');
                    $nama = trim($row['B'] ?? '');
                    $kelas = trim($row['C'] ?? '');
                    $jurusan = trim($row['D'] ?? '');

                    if (empty($nis) || str_contains(strtolower($nis), 'tahun pelajaran')) continue;
                    $nis = substr($nis, 0, 20);

                    \App\Models\Siswa::updateOrCreate(
                        ['nis' => $nis],
                        [
                            'nama' => $nama,
                            'kelas' => $kelas,
                            'jurusan' => $jurusan,
                            'riwayat_penyakit' => null,
                        ]
                    );

                    $totalImported++;
                }
            }
        }

        DB::commit();
        return back()->with('success', "✅ Import berhasil! Total: {$totalImported} siswa.");
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', '❌ Gagal import data: ' . $e->getMessage());
    }
}
}


