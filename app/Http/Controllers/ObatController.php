<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin,petugas'])
        ->except(['index', 'show']);
    }

    // List semua obat
    public function index()
    {
        $obat = Obat::orderBy('nama')->get();
        return view('obat.index', compact('obat'));
    }

    // Form tambah
    public function create()
    {
        return view('obat.create');
    }

    // Simpan obat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_obat'    => 'required|string|max:100',
            'bentuk_obat'   => 'required|string|max:100',
            'dosis_per_hari'=> 'required|integer|min:1',
            'stock'         => 'required|integer|min:0',
        ]);

        Obat::create([
            'nama'          => $request->nama,
            'jenis_obat'    => $request->jenis_obat,
            'bentuk_obat'   => $request->bentuk_obat,
            'dosis_per_hari'=> $request->dosis_per_hari,
            'stock'         => $request->stock,
        ]);

        return redirect()->route('obat.index')->with('success','Obat berhasil ditambahkan.');
    }

    // Form edit
    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    // Detail
    public function show(Obat $obat)
    {
        return view('obat.show', compact('obat'));
    }

    // Update obat
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_obat'    => 'required|string|max:100',
            'bentuk_obat'   => 'required|string|max:100',
            'kategori_dosis'=> 'nullable|string|max:100',
            'dosis_per_hari'=> 'required|integer|min:1',
            'stock'         => 'required|integer|min:0',
        ]);

        $obat->update([
            'nama'          => $request->nama,
            'jenis_obat'    => $request->jenis_obat,   // ✅ fix mapping
            'bentuk_obat'   => $request->bentuk_obat, // ✅ fix mapping
            'kategori_dosis'=> $request->kategori_dosis,
            'dosis_per_hari'=> $request->dosis_per_hari,
            'stock'         => $request->stock,
        ]);

        return redirect()->route('obat.index')->with('success','Obat berhasil diupdate.');
    }

    // Hapus obat
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success','Obat berhasil dihapus.');
    }
}
