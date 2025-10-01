<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $petugas = User::where('role', 'petugas')->latest()->paginate(10);
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'petugas',
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function edit(User $petuga) // otomatis pakai singular dari 'petugas'
    {
        return view('petugas.edit', ['petugas' => $petuga]);
    }

    public function update(Request $request, User $petuga)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petuga->id,
        ]);

        $data = $request->only(['name','email']);
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $petuga->update($data);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui!');
    }

    public function destroy(User $petuga)
    {
        $petuga->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus!');
    }
}
