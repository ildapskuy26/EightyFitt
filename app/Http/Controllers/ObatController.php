<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // Middleware auth & role
    public function __construct()
    {
        $this->middleware(['auth','role:admin,petugas']);
    }

    // List semua obat
    public function index()
    {
        $obat = Obat::orderBy('nama')->get();
        return view('obat.index', compact('obat'));
    }

    // Form tambah obat
    public function create()
    {
        return view('obat.create');
    }

    // Simpan obat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'bentuk' => 'nullable|string|max:100',
            'kategori_dosis' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')->with('success','Obat berhasil ditambahkan.');
    }

    // Form edit obat
    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    // Detail obat
public function show(Obat $obat)
{
    return view('obat.show', compact('obat'));
}


    // Update obat
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'bentuk' => 'nullable|string|max:100',
            'kategori_dosis' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $obat->update($request->all());

        return redirect()->route('obat.index')->with('success','Obat berhasil diupdate.');
    }

    // Hapus obat
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success','Obat berhasil dihapus.');
    }
}
