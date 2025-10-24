<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string|max:1000',
        ]);

        Tanggapan::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah dikirim.');
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
