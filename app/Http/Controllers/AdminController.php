<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Kunjungan;
use App\Models\Siswa;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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

    try {
        DB::beginTransaction();
        $totalImported = 0;

        foreach ($request->file('files') as $file) {
            $extension = $file->getClientOriginalExtension();

            if ($extension === 'csv') {
                // === Jika format CSV ===
                $handle = fopen($file->getRealPath(), 'r');
                $header = true;
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    if ($header) {
                        $header = false;
                        continue; // skip baris header
                    }

                    $nis = trim($row[0] ?? '');
                    $nama = trim($row[1] ?? '');
                    $kelas = trim($row[2] ?? '');
                    $jurusan = trim($row[3] ?? '');

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
                fclose($handle);
            } else {
                // === Jika format Excel (xls/xlsx) ===
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray(null, true, true, true);

                foreach ($rows as $index => $row) {
                    if ($index == 1) continue; // skip header

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