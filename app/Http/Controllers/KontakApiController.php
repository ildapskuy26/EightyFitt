<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak'); // view kontak.blade.php
    }

    public function send(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'pesan' => 'required|string',
        ]);

        $wa_number = '6285732072037'; // nomor WA aktif di Z-API
        $message = "Nama: {$request->nama}\n";
        if($request->email) $message .= "Email: {$request->email}\n";
        $message .= "Pesan: {$request->pesan}";

        // Kirim ke Z-API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.z-api.io/instances/3E83EAB0E5D962E4A64ADA24232E6C75/token/572E9C63A65A2041E050AB8D/send-text', [
            'phone' => $wa_number,
            'message' => $message
        ]);

        $data = $response->json(); // ambil response Z-API

        // Debug: tampilkan error dari Z-API jika gagal
        if(!$response->successful() || isset($data['error'])) {
            return response()->json([
                'success' => false,
                'message' => $data['error'] ?? 'Terjadi kesalahan saat mengirim pesan.'
            ]);
        }

        // Berhasil
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!',
            'wa_link' => "https://wa.me/{$wa_number}?text=" . urlencode($message)
        ]);
    }
}
