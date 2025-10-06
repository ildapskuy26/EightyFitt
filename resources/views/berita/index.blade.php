@extends('layouts.app')

@section('content')
<div class="container py-4 fade-in-up">

    {{-- ✨ Tombol tambah berita (hanya admin/petugas) --}}
    @auth
        @if(in_array(auth()->user()->role, ['admin','petugas']))
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('berita.create') }}" 
                   class="btn btn-primary shadow-sm d-flex align-items-center gap-2 btn-hover-animate">
                    <i class="bi bi-plus-circle"></i> Tambah Berita
                </a>
            </div>
        @endif
    @endauth

    {{-- 📰 Daftar Berita --}}
    @forelse($berita as $b)
        <div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden hover-card card-animate">
            <div class="row g-0">
                {{-- Gambar berita --}}
                @if($b->gambar)
                    <div class="col-md-4">
                        <img src="{{ asset('storage/'.$b->gambar) }}" 
                             class="img-fluid w-100 h-100 object-fit-cover" 
                             alt="Gambar Berita"
                             style="min-height:220px;">
                    </div>
                @endif

                {{-- Konten berita --}}
                <div class="{{ $b->gambar ? 'col-md-8' : 'col-md-12' }}">
                    <div class="card-body d-flex flex-column justify-content-between h-100 p-4">
                        <div>
                            <h4 class="card-title fw-bold text-gradient mb-2">
                                {{ $b->judul }}
                            </h4>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-calendar-event"></i> {{ $b->created_at->format('d M Y') }}
                            </p>
                            <p class="card-text text-secondary">{{ Str::limit($b->isi, 160) }}</p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-3 d-flex flex-wrap gap-2">
                            <a href="{{ route('berita.show', $b->id) }}" 
                               class="btn btn-sm btn-info shadow-sm d-flex align-items-center gap-1 btn-hover-animate">
                                <i class="bi bi-eye-fill"></i> Baca
                            </a>

                            @auth
                                @if(in_array(auth()->user()->role, ['admin','petugas']))
                                    <a href="{{ route('berita.edit', $b->id) }}" 
                                       class="btn btn-sm btn-warning shadow-sm d-flex align-items-center gap-1 btn-hover-animate">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm d-flex align-items-center gap-1 btn-hover-animate"
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
    @empty
        <div class="alert alert-info text-center shadow-sm animate-alert">
            <i class="bi bi-info-circle-fill"></i> Belum ada berita.
        </div>
    @endforelse

    {{-- 📄 Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $berita->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- 🌈 CSS Custom --}}
<style>
    /* Gradient teks */
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Efek fade-in saat halaman dibuka */
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease forwards;
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Efek hover card */
    .hover-card {
        transition: all 0.3s ease;
        background-color: #fff;
    }
    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12) !important;
    }

    /* Efek hover tombol */
    .btn-hover-animate {
        transition: all 0.25s ease-in-out;
    }
    .btn-hover-animate:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Efek animasi tiap kartu */
    .card-animate {
        animation: slideUp 0.6s ease forwards;
        opacity: 0;
    }
    .card-animate:nth-child(1) { animation-delay: 0.1s; }
    .card-animate:nth-child(2) { animation-delay: 0.2s; }
    .card-animate:nth-child(3) { animation-delay: 0.3s; }
    .card-animate:nth-child(4) { animation-delay: 0.4s; }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Alert muncul lembut */
    .animate-alert {
        animation: popIn 0.5s ease;
    }
    @keyframes popIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
