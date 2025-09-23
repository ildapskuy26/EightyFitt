<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Obat;
use App\Models\Kunjungan;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kunjungan, bisa diurutkan terbaru
        $kunjungan = Kunjungan::with('obat')->orderBy('waktu_kedatangan','desc')->get();
        return view('kunjungan.index', compact('kunjungan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $obat = Obat::all();
        return view('kunjungan.create', compact('siswa', 'obat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis'=>'required|exists:siswa,nis',
            'waktu_kedatangan'=>'required|date',
            'keluhan'=>'nullable|string',
            'obat_id'=>'nullable|exists:obat,id',
        ]);

        $siswa = Siswa::where('nis',$request->nis)->first();

        Kunjungan::create([
            'nis'=>$siswa->nis,
            'nama'=>$siswa->nama,
            'kelas'=>$siswa->kelas,
            'jurusan'=>$siswa->jurusan,
            'waktu_kedatangan'=>$request->waktu_kedatangan,
            'waktu_keluar'=>$request->waktu_keluar,
            'keluhan'=>$request->keluhan,
            'obat_id'=>$request->obat_id,
        ]);

        return redirect()->route('kunjungan.index')->with('success','Data kunjungan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        return view('kunjungan.show', compact('kunjungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $siswa = Siswa::all();
        $obat = Obat::all();
        return view('kunjungan.edit', compact('kunjungan','siswa','obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
            'nis'=>'required|exists:siswa,nis',
            'waktu_kedatangan'=>'required|date',
            'keluhan'=>'nullable|string',
            'obat_id'=>'nullable|exists:obat,id',
        ]);

        $siswa = Siswa::where('nis',$request->nis)->first();
        $kunjungan = Kunjungan::findOrFail($id);

        $kunjungan->update([
            'nis'=>$siswa->nis,
            'nama'=>$siswa->nama,
            'kelas'=>$siswa->kelas,
            'jurusan'=>$siswa->jurusan,
            'waktu_kedatangan'=>$request->waktu_kedatangan,
            'waktu_keluar'=>$request->waktu_keluar,
            'keluhan'=>$request->keluhan,
            'obat_id'=>$request->obat_id,
        ]);

        return redirect()->route('kunjungan.index')->with('success','Data kunjungan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')->with('success','Data kunjungan berhasil dihapus.');
    }
}
