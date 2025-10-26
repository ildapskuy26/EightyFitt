<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    // Tampilkan semua siswa
    public function index()
    {
        $siswa = User::where('role', 'siswa')->latest()->paginate(10);
        return view('siswa.index', compact('siswa'));
    }

    // Simpan siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect()->route('petugas.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    // Form edit siswa
    public function edit(User $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    // Update siswa
    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$siswa->id,
        ]);

        $siswa->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Siswa berhasil diupdate!');
    }

    // Hapus siswa
    public function destroy(User $siswa)
    {
        $siswa->delete();
        return redirect()->route('petugas.index')->with('success', 'Siswa berhasil dihapus!');
    }
}