<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        // 🔍 Filter berdasarkan judul berita
        if ($request->filled('judul')) {
            $query->where('judul', 'like', "%{$request->judul}%");
        }

        // 📅 Filter berdasarkan tanggal dibuat
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // 👤 Filter berdasarkan pembuat (role)
        if ($request->filled('pembuat')) {
            // Pastikan ada relasi user() di model Berita
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->pembuat);
            });
        }

        // Urutkan berita terbaru dan aktifkan pagination + query string
        $berita = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('berita.index', compact('berita'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Tambahkan kolom 'views' default 0
        $data['views'] = 0;

        // Simpan id user pembuat berita (opsional tapi disarankan)
        $data['user_id'] = auth()->id();

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(Berita $berita)
    {
        // === Hitung jumlah view (sekali per sesi) ===
        $sessionKey = 'berita_viewed_' . $berita->id;

        if (!session()->has($sessionKey)) {
            $berita->increment('views');
            session([$sessionKey => true]);
        }

        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
