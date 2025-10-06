@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                {{-- Hero Gambar --}}
                @if($berita->gambar)
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" 
                             class="img-fluid w-100"
                             style="max-height: 450px; object-fit: cover;" 
                             alt="gambar berita">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient"
                             style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            <h1 class="fw-bold text-white">{{ $berita->judul }}</h1>
                        </div>
                    </div>
                @endif

                {{-- Body Berita --}}
                <div class="card-body p-4">
                    
                    {{-- Judul (jika tanpa gambar) --}}
                    @if(!$berita->gambar)
                        <h2 class="fw-bold mb-3 text-gradient">
                            {{ $berita->judul }}
                        </h2>
                    @endif

                    {{-- Info meta --}}
                    <p class="text-muted small mb-4">
                        <i class="bi bi-calendar-event"></i> {{ $berita->created_at->format('d M Y') }}
                        <span class="mx-2">•</span>
                        <i class="bi bi-person-circle"></i> Admin
                    </p>

                    {{-- Deskripsi singkat --}}
                    @if(!empty($berita->deskripsi))
                        <p class="text-secondary fst-italic mb-4 border-start ps-3">
                            {{ $berita->deskripsi }}
                        </p>
                    @endif

                    {{-- Isi berita --}}
                    <div class="card-text mb-4" style="line-height:1.9; font-size:1.1rem; color:#333;">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="{{ route('berita.index') }}" 
                           class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        @auth
                            @if(in_array(auth()->user()->role, ['admin','petugas']))
                                <a href="{{ route('berita.edit', $berita) }}" 
                                   class="btn btn-warning text-white d-flex align-items-center gap-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('berita.destroy', $berita) }}" 
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger d-flex align-items-center gap-1"
                                            onclick="return confirm('Hapus berita ini?')">
                                        <i class="bi bi-trash-fill"></i> Hapus
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

{{-- CSS Custom --}}
<style>
    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .card-text p {
        margin-bottom: 1rem;
    }
    .btn {
        transition: all 0.2s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
    @media (max-width: 768px) {
        h1, h2 {
            font-size: 1.6rem !important;
        }
        .card-text {
            font-size: 1rem !important;
        }
    }
</style>
@endsection
