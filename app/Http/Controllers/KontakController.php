<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak'); // memanggil view kontak.blade.php
    }

    public function send(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'pesan' => 'required|string',
        ]);

        // Nomor WhatsApp tujuan (pengurus)
        $wa_number = '6285732072037';

        // Buat pesan
        $message = "Nama: {$request->nama}\n";
        if ($request->email) $message .= "Email: {$request->email}\n";
        $message .= "Pesan: {$request->pesan}";

        // Redirect ke WhatsApp dengan pesan
        $wa_link = "https://wa.me/{$wa_number}?text=" . urlencode($message);

        return redirect($wa_link);
    }
}
