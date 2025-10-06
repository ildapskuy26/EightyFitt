<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Obat;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;

class KunjunganController extends Controller
{
    public function index(Request $request)
{
    $query = Kunjungan::with('obat');

    // Filter pencarian
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('nis', 'like', "%{$request->keyword}%")
              ->orWhere('nama', 'like', "%{$request->keyword}%");
        });
    }

    // Filter kelas
    if ($request->filled('kelas')) {
        $query->where('kelas', 'like', "%{$request->kelas}%");
    }

    // Filter jurusan
    if ($request->filled('jurusan')) {
        $query->where('jurusan', 'like', "%{$request->jurusan}%");
    }

    // Filter rentang tanggal
    if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
        $query->whereBetween('waktu_kedatangan', [
            $request->tanggal_mulai . ' 00:00:00',
            $request->tanggal_selesai . ' 23:59:59'
        ]);
    }

    $kunjungan = $query->latest()->get();

    return view('kunjungan.index', compact('kunjungan'));
}


    public function create()
    {
        $siswa = Siswa::all();
        $obat  = Obat::all();

        return view('kunjungan.create', compact('siswa', 'obat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis'              => 'required|exists:siswa,nis',
            'waktu_kedatangan' => 'required|date',
            'waktu_keluar'     => 'nullable|date|after_or_equal:waktu_kedatangan',
            'keluhan'          => 'nullable|string',
            'obat_id'          => 'nullable|exists:obat,id',
        ]);

        $siswa = Siswa::where('nis', $validated['nis'])->firstOrFail();

        Kunjungan::create(array_merge($validated, [
            'nama'    => $siswa->nama,
            'kelas'   => $siswa->kelas,
            'jurusan' => $siswa->jurusan,
        ]));

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil ditambahkan.');
    }

    public function show(Kunjungan $kunjungan)
    {
        return view('kunjungan.show', compact('kunjungan'));
    }

    public function edit(Kunjungan $kunjungan)
    {
        $siswa = Siswa::all();
        $obat  = Obat::all();

        return view('kunjungan.edit', compact('kunjungan', 'siswa', 'obat'));
    }

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

        $kunjungan->update(array_merge($validated, [
            'nama'    => $siswa->nama,
            'kelas'   => $siswa->kelas,
            'jurusan' => $siswa->jurusan,
        ]));

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil dihapus.');
    }

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
}
