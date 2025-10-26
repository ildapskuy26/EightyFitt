<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class SiswaProfileController extends Controller
{
    /**
     * Tampilkan halaman profil siswa yang sedang login.
     */
    public function show()
    {

        /** @var \App\Models\Siswa $siswa */
$siswa = Auth::guard('siswa')->user();

        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('siswa.profile', compact('siswa'));
    }

    /**
     * Update data profil siswa (nama, kelas, jurusan, dan password).
     */
    public function update(Request $request)
{
    /** @var \App\Models\Siswa $siswa */
    $siswa = Auth::guard('siswa')->user();


        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Sesi login sudah berakhir.');
        }

        $request->validate([
            'nama'     => 'required|string|max:255',
            'kelas'    => 'required|string|max:255',
            'jurusan'  => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update data umum
        $siswa->nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->jurusan = $request->jurusan;

        // Jika password diisi, hash otomatis (karena ada setPasswordAttribute di model)
        if ($request->filled('password')) {
            $siswa->password = $request->password;
        }

        $siswa->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
