@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- 🌟 Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-gradient-primary m-0">
            <i class="bi bi-pencil-square me-2"></i> Edit Berita
        </h3>
       
    </div>

    {{-- ⚠️ Error Validation --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded-3 p-3 mb-4">
            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Oops!</strong> Ada beberapa kesalahan input:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 📝 Form Edit --}}
    <div class="card shadow-lg border-0 rounded-4 p-4 p-lg-5 animate-fade-in">
        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-4">
                <label for="judul" class="form-label fw-semibold">Judul Berita</label>
                <input type="text" name="judul" id="judul" 
                       class="form-control form-control-lg rounded-3 shadow-sm" 
                       placeholder="Masukkan judul berita..." 
                       value="{{ old('judul', $berita->judul) }}" required>
            </div>

            {{-- Isi --}}
            <div class="mb-4">
                <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                <textarea name="isi" id="isi" rows="6" 
                          class="form-control rounded-3 shadow-sm" 
                          placeholder="Tulis isi berita di sini..." 
                          required>{{ old('isi', $berita->isi) }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-4">
                <label for="gambar" class="form-label fw-semibold">Gambar</label>
                <input type="file" name="gambar" id="gambar" 
                       class="form-control rounded-3 shadow-sm">
                @if($berita->gambar)
                    <div class="mt-3">
                        <p class="text-muted mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/'.$berita->gambar) }}" 
                             alt="Gambar berita" 
                             class="img-thumbnail rounded-3 shadow-sm"
                             style="max-width: 200px; height: auto;">
                    </div>
                @endif
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary rounded-pill px-4 d-flex align-items-center gap-2">
                    <i class="bi bi-x-circle"></i> <span>Batal</span>
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2 btn-hover-lift">
                    <i class="bi bi-save-fill"></i> <span>Update Berita</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- 💅 Custom CSS --}}
<style>
    .text-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .btn-hover-lift {
        transition: all 0.3s ease;
    }
    .btn-hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .animate-fade-in {
        animation: fadeInUp 0.5s ease-in-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
