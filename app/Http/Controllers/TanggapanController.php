<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan'  => 'required|string',
        ]);

        Tanggapan::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'subjek' => $request->subjek,
            'pesan'  => $request->pesan,
            'status' => 'baru',
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }

    // Tampilkan semua tanggapan (untuk admin/petugas)
    public function index()
    {
        $tanggapans = Tanggapan::latest()->paginate(10);
        return view('admin.tanggapan.index', compact('tanggapans'));
    }

    // Ubah status jadi dibaca
    public function markAsRead($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->update(['status' => 'dibaca']);
        return redirect()->back()->with('success', 'Tanggapan telah ditandai sebagai dibaca.');
    }
}
