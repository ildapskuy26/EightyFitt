<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $obats = \App\Models\Obat::all();
        return view('obat.index', compact('obats'));
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
        'nama'          => 'required|string|max:255|unique:obat,nama',
        'jenis_obat'    => 'required|string|max:100',
        'bentuk_obat'   => 'required|string|max:100',
        'dosis_per_hari'=> 'required|integer|min:1',
        'stock'         => 'required|integer|min:0',
        'stok_terpakai' => 'nullable|integer|min:0',
        'kadar'         => 'nullable|string|max:50',
    ], [
        'nama.unique'   => 'Nama obat ini sudah terdaftar, silahkan edit obat tersebut.',
        'nama.required' => 'Nama obat wajib diisi.',
        'stock.required'=> 'Stok awal wajib diisi.',
    ]);

        Obat::create([
            'nama'          => $request->nama,
            'jenis_obat'    => $request->jenis_obat,
            'bentuk_obat'   => $request->bentuk_obat,
            'dosis_per_hari'=> $request->dosis_per_hari,
            'stock'         => $request->stock,
            'stok_terpakai' => $request->stok_terpakai ?? 0,
            'kadar'         => $request->kadar,
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
        'nama'          => 'required|string|max:255|unique:obat,nama,' . $obat->id,
        'jenis_obat'    => 'required|string|max:100',
        'bentuk_obat'   => 'required|string|max:100',
        'dosis_per_hari'=> 'required|integer|min:1',
        'stock'         => 'required|integer|min:0',
        'stok_terpakai' => 'nullable|integer|min:0',
        'kadar'         => 'nullable|string|max:50',
    ], [
        'nama.unique'   => 'Nama obat ini sudah digunakan oleh obat lain.',
        'nama.required' => 'Nama obat wajib diisi.',
    ]);

        // Hitung stok akhir
        $stok_terpakai = $request->stok_terpakai ?? 0;
        $stok_akhir = max(0, $request->stock - $stok_terpakai);

        $obat->update([
            'nama'          => $request->nama,
            'jenis_obat'    => $request->jenis_obat,   // ✅ fix mapping
            'bentuk_obat'   => $request->bentuk_obat, // ✅ fix mapping
            'kategori_dosis'=> $request->kategori_dosis,
            'dosis_per_hari'=> $request->dosis_per_hari,
            'stock'         => $stok_akhir,
            'stok_terpakai' => $stok_terpakai,
            'kadar'         => $request->kadar,
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
