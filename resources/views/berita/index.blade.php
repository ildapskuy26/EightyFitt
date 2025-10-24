@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5 bg-gradient-light">

    {{-- ✨ Hero Header Section --}}
<div class="row justify-content-center mb-5">
    <div class="col-lg-10 text-center">
        <div class="hero-header animate-fade-in">
            <h1 class="display-4 fw-bold text-gradient-primary mb-3">Berita Terbaru</h1>
            <p class="lead text-muted mb-4">
                @if(in_array(auth()->user()->role, ['admin','petugas']))
                    Kelola berita terbaru untuk ditampilkan kepada siswa dan guru.
                @else
                    Temukan informasi dan berita terbaru dari UKS.
                @endif
            </p>

            {{-- 🌟 Tombol Tambah + Filter Berita --}}
<div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mt-4 mb-5">

    {{-- ➕ Tombol Tambah Berita --}}
    @if(in_array(auth()->user()->role, ['admin','petugas']))
        <a href="{{ route('berita.create') }}"
           class="btn btn-primary shadow-lg rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 btn-hover-lift">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Berita Baru</span>
        </a>
    @endif

    {{-- 🔍 Tombol Filter Berita --}}
    <div class="dropdown">
        <button class="btn btn-outline-secondary rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 btn-hover-lift dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="bi bi-funnel"></i>
            <span>Filter Berita</span>
        </button>

        {{-- 🎯 Dropdown Isi Filter --}}
        <div class="dropdown-menu p-4 shadow-lg border-0 rounded-4" style="min-width: 300px;">
            <form method="GET" action="{{ route('berita.index') }}" class="d-flex flex-column gap-3">

                {{-- 📰 Filter Berdasarkan Nama (Judul Berita) --}}
                <div>
                    <label for="judul" class="form-label fw-semibold">Judul Berita</label>
                    <input type="text"
                           name="judul"
                           id="judul"
                           value="{{ request('judul') }}"
                           class="form-control"
                           placeholder="Masukkan judul berita...">
                </div>

                {{-- 📅 Filter Berdasarkan Tanggal --}}
                <div>
                    <label for="tanggal" class="form-label fw-semibold">Tanggal Dibuat</label>
                    <input type="date"
                           name="tanggal"
                           id="tanggal"
                           value="{{ request('tanggal') }}"
                           class="form-control">
                </div>

                {{-- 🔘 Tombol Aksi --}}
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <button type="submit" class="btn btn-success rounded-pill px-3 py-1">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    @if(request()->hasAny(['judul','tanggal']))
                        <a href="{{ route('berita.index') }}"
                           class="btn btn-outline-secondary rounded-pill px-3 py-1">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

</div>



    {{-- 📰 Daftar Berita --}}
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @forelse($berita as $b)
                <div class="news-card card border-0 shadow-lg rounded-4 overflow-hidden mb-5 animate-slide-up" 
                     style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="row g-0">
                        {{-- Gambar --}}
                        @if($b->gambar)
                            <div class="col-md-5 position-relative">
                                <img src="{{ asset('storage/'.$b->gambar) }}" 
                                     class="img-fluid w-100 h-100 news-image" 
                                     alt="Gambar Berita"
                                     style="min-height: 280px; object-fit: cover;">
                                <div class="image-overlay"></div>
                            </div>
                        @endif

                        {{-- Konten --}}
                        <div class="{{ $b->gambar ? 'col-md-7' : 'col-12' }}">
                            <div class="card-body d-flex flex-column justify-content-between h-100 p-4 p-lg-5">

                                {{-- 🧾 Info --}}
                                <div>
                                    <div class="d-flex align-items-center flex-wrap gap-4 mb-3 small text-muted info-meta">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-event me-2 icon-muted"></i>
                                            {{ $b->created_at->format('d F Y') }}
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle me-2 icon-muted"></i>
                                            Admin
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-eye me-2 icon-muted"></i>
                                            {{ $b->views }} kali dibaca
                                        </div>
                                    </div>

                                    {{-- Judul & deskripsi --}}
                                    <h3 class="card-title fw-bold text-dark mb-3 line-clamp-2 hover-title">
                                        {{ $b->judul }}
                                    </h3>
                                    <p class="card-text text-secondary mb-4 line-clamp-3">
                                        {{ $b->deskripsi ?? Str::limit(strip_tags($b->isi), 200) }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 border-top">
                                    @auth
                                        @if(in_array(auth()->user()->role, ['admin','petugas']))
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('berita.edit', $b->id) }}" 
                                                   class="btn btn-outline-warning rounded-pill px-3 py-2 d-flex align-items-center gap-1 btn-hover-lift">
                                                    <i class="bi bi-pencil-square"></i> <span>Edit</span>
                                                </a>
                                                <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-outline-danger rounded-pill px-3 py-2 d-flex align-items-center gap-1 btn-hover-lift"
                                                            onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                                        <i class="bi bi-trash-fill"></i> <span>Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <a href="{{ route('berita.show', $b->id) }}" 
                                               class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2 btn-hover-lift">
                                                <i class="bi bi-eye-fill"></i> 
                                                <span>Baca Selengkapnya</span>
                                            </a>
                                        @endif
                                    @endauth
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Jika belum ada berita --}}
                <div class="empty-state text-center py-5 my-5 animate-fade-in">
                    <div class="empty-icon mb-4">
                        <i class="bi bi-newspaper display-1 text-muted opacity-25"></i>
                    </div>
                    <h4 class="fw-bold text-muted mb-3">Belum Ada Berita</h4>
                    <p class="text-muted mb-4">Saat ini belum ada berita yang tersedia.</p>
                    @auth
                        @if(in_array(auth()->user()->role, ['admin','petugas']))
                            <a href="{{ route('berita.create') }}" 
                               class="btn btn-primary btn-lg rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-plus-circle"></i> 
                                <span>Buat Berita Pertama</span>
                            </a>
                        @endif
                    @endauth
                </div>
            @endforelse
        </div>
    </div>

    {{-- 📄 Pagination --}}
    @if($berita->hasPages())
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="pagination-wrapper bg-white rounded-4 shadow-sm p-4 animate-fade-in">
                    {{ $berita->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>

{{-- 🌈 CSS --}}
<style>
    .bg-gradient-light {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        min-height: 100vh;
    }
    .text-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .news-card {
        transition: all 0.4s ease;
        background: #fff;
    }
    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(0,0,0,0.12);
    }
    .image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.15), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .news-card:hover .image-overlay {
        opacity: 1;
    }
    .btn-hover-lift {
        transition: all 0.3s ease;
    }
    .btn-hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .icon-muted {
        color: #6c757d;
    }
    .info-meta div {
        display: flex;
        align-items: center;
    }
    .hover-title:hover {
        color: #0056b3;
        transition: color 0.3s ease;
    }
    .line-clamp-2, .line-clamp-3 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-2 { -webkit-line-clamp: 2; }
    .line-clamp-3 { -webkit-line-clamp: 3; }
    .empty-state {
        background: rgba(255,255,255,0.85);
        border-radius: 20px;
        backdrop-filter: blur(8px);
    }

    /* 🌈 Tombol Tambah + Filter di Tengah dan Beri Jarak Bawah */
    .hero-header .action-buttons {
        margin-top: 1.5rem;
        margin-bottom: 3rem; /* jarak lebih besar dari konten di bawah */
    }

    .hero-header .btn {
        transition: all 0.3s ease;
    }

    .hero-header .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    /* Responsif: Tengah di mobile, sejajar di desktop */
    @media (min-width: 768px) {
        .hero-header .d-flex {
            justify-content: center;
            align-items: center;
        }
    }
</style>
@endsection
