<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Kunjungan;
use App\Models\Siswa;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

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
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            DB::beginTransaction();

            // Lewati baris pertama (header)
            foreach ($rows as $index => $row) {
                if ($index == 1) continue;

                Siswa::updateOrCreate(
                    ['nis' => $row['A']], // kolom A = NIS
                    [
                        'nama' => $row['B'] ?? null,
                        'kelas' => $row['C'] ?? null,
                        'jurusan' => $row['D'] ?? null,
                        'riwayat_penyakit' => $row['E'] ?? null,
                    ]
                );
            }

            DB::commit();
            return back()->with('success', 'Data siswa berhasil diimport!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }
}