<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Http;

class KontakApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'nomor' => 'nullable|string',
            'pesan' => 'required|string',
        ]);

        // Simpan ke database
        $kontak = Kontak::create($request->all());

        // Kirim pesan ke WhatsApp pengurus
        $this->sendToWA($kontak);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!'
        ]);
    }

    private function sendToWA($kontak)
{
    $wa_number = '6285732072037'; // ganti dengan nomor pengurus
    $message = "Pesan dari: {$kontak->nama}\n";
    if($kontak->email) $message .= "Email: {$kontak->email}\n";
    if($kontak->nomor) $message .= "Nomor: {$kontak->nomor}\n";
    $message .= "Isi Pesan: {$kontak->pesan}";

    try {
        Http::post('https://api.z-api.io/instances/3E83EAB0E5D962E4A64ADA24232E6C75/token/572E9C63A65A2041E050AB8D/send-text', [
            'phone' => $wa_number,
            'message' => $message
        ]);

        return "https://wa.me/{$wa_number}?text=" . urlencode($message);

    } catch (\Exception $e) {
        return "https://wa.me/{$wa_number}?text=" . urlencode($message);
    }
}

}
