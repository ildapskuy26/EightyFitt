@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                {{-- Gambar berita --}}
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                         class="card-img-top img-fluid rounded-top"
                         style="max-height: 400px; object-fit: cover;" 
                         alt="gambar berita">
                @endif

                <div class="card-body p-4">
                    {{-- Judul --}}
                    <h2 class="card-title fw-bold mb-3 text-primary">
                        {{ $berita->judul }}
                    </h2>

                    {{-- Deskripsi singkat --}}
                    @if(!empty($berita->deskripsi))
                        <p class="text-muted fst-italic mb-4">
                            {{ $berita->deskripsi }}
                        </p>
                    @endif

                    {{-- Isi berita --}}
                    <div class="card-text mb-4" style="line-height:1.8; font-size:1.05rem;">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                            ← Kembali
                        </a>
                        @auth
                            @if(in_array(auth()->user()->role, ['admin','petugas']))
                                <a href="{{ route('berita.edit', $berita) }}" class="btn btn-warning text-white">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('berita.destroy', $berita) }}" 
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" 
                                            onclick="return confirm('Hapus berita ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Style tambahan --}}
<style>
    @media (max-width: 768px) {
        h2.card-title {
            font-size: 1.5rem;
        }
        .card-text {
            font-size: 1rem;
        }
    }
</style>
@endsection
