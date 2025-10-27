@extends('layouts.app')

@section('content')
@php
    // Aman untuk guest: ambil role jika user login, else null
    $role = optional(auth()->user())->role;
    $isGuest = !auth()->check();
@endphp

<div class="container-fluid px-4 py-4 bg-light min-vh-100">

    {{-- ✨ Header Section --}}
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <div class="hero-section text-center animate-fade-in">
                <div class="news-icon-main mb-3">
                    <i class="bi bi-newspaper text-success"></i>
                </div>

                <h1 class="display-6 fw-bold text-success mb-2" style="font-family: 'Poppins', sans-serif;">
                    Berita Terkini UKS
                </h1>
                <p class="lead text-muted mb-4" style="font-family: 'Inter', sans-serif;">
                    @if(in_array($role, ['admin','petugas']))
                        Kelola informasi dan berita untuk komunitas sekolah
                    @else
                        Informasi terbaru seputar kesehatan dari UKS SMKN 8 Jakarta
                    @endif
                </p>

                {{-- Action Buttons HANYA untuk Admin/Petugas --}}
                @if(in_array($role, ['admin','petugas']))
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mb-4">
                    <a href="{{ route('berita.create') }}"
                       class="btn btn-success btn-lg px-4 py-2 d-flex align-items-center gap-2 rounded-3">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                        <span class="fw-semibold" style="font-family: 'Poppins', sans-serif;">Tambah Berita</span>
                    </a>

                    {{-- Filter Button --}}
                    <div class="dropdown">
                        <button class="btn btn-outline-success btn-lg px-4 py-2 d-flex align-items-center gap-2 rounded-3 dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-funnel fs-5"></i>
                            <span class="fw-semibold" style="font-family: 'Poppins', sans-serif;">Filter</span>
                        </button>
                        <div class="dropdown-menu p-3 shadow border-0 rounded-3" style="min-width: 280px;">
                            <form method="GET" action="{{ route('berita.index') }}">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" style="font-family: 'Poppins', sans-serif;">Judul Berita</label>
                                    <input type="text" name="judul" value="{{ request('judul') }}" 
                                           class="form-control rounded-2" placeholder="Cari judul...">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" style="font-family: 'Poppins', sans-serif;">Tanggal</label>
                                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                                           class="form-control rounded-2">
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success btn-sm flex-fill" style="font-family: 'Poppins', sans-serif;">
                                        <i class="bi bi-search me-1"></i>Cari
                                    </button>
                                    @if(request()->hasAny(['judul','tanggal']))
                                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary btn-sm" style="font-family: 'Poppins', sans-serif;">
                                            Reset
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- 📰 News List --}}
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            @forelse($berita as $index => $b)
                {{-- Tampilan untuk Admin/Petugas --}}
                @if(in_array($role, ['admin','petugas']))
                    <div class="card news-item border-0 shadow-sm rounded-3 mb-4 animate-slide-up" 
                         style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="card-body p-4">
                            <div class="row align-items-start">
                                {{-- News Icon & Meta --}}
                                <div class="col-auto">
                                    <div class="news-icon bg-success text-white rounded-3 p-3 mb-2">
                                        <i class="bi bi-newspaper fs-4"></i>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="col">
                                    <div class="news-content">
                                        {{-- Meta Info --}}
                                        <div class="news-meta d-flex flex-wrap gap-3 mb-2">
                                            <small class="text-muted d-flex align-items-center gap-1" style="font-family: 'Inter', sans-serif;">
                                                <i class="bi bi-calendar3"></i>
                                                {{ $b->created_at->format('d M Y') }}
                                            </small>
                                            <small class="text-muted d-flex align-items-center gap-1" style="font-family: 'Inter', sans-serif;">
                                                <i class="bi bi-person"></i>
                                                Admin
                                            </small>
                                            <small class="text-muted d-flex align-items-center gap-1" style="font-family: 'Inter', sans-serif;">
                                                <i class="bi bi-eye"></i>
                                                {{ $b->views ?? 0 }}x
                                            </small>
                                        </div>

                                        {{-- Title --}}
                                        <h4 class="news-title fw-bold text-dark mb-2" style="font-family: 'Poppins', sans-serif;">
                                            {{ $b->judul }}
                                        </h4>

                                        {{-- Description --}}
                                        <p class="news-desc text-muted mb-3" style="font-family: 'Inter', sans-serif;">
                                            {{ $b->deskripsi ?? Str::limit(strip_tags($b->isi), 150) }}
                                        </p>

                                        {{-- Image Preview if exists --}}
                                        @if($b->gambar)
                                            <div class="news-image-preview mb-3">
                                                <img src="{{ asset('storage/'.$b->gambar) }}" 
                                                     alt="{{ $b->judul }}"
                                                     class="img-fluid rounded-2" 
                                                     style="max-height: 200px; width: auto;">
                                            </div>
                                        @endif

                                        {{-- Actions untuk Admin/Petugas + Tombol Baca --}}
                                        <div class="news-actions d-flex flex-wrap gap-2 align-items-center">
                                            <a href="{{ route('berita.show', $b->id) }}" 
                                               class="btn btn-success btn-sm d-flex align-items-center gap-1" style="font-family: 'Poppins', sans-serif;">
                                                <i class="bi bi-eye"></i> Baca
                                            </a>
                                            <a href="{{ route('berita.edit', $b->id) }}" 
                                               class="btn btn-outline-warning btn-sm d-flex align-items-center gap-1" style="font-family: 'Poppins', sans-serif;">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" style="font-family: 'Poppins', sans-serif;"
                                                        onclick="return confirm('Hapus berita ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Tampilan untuk User/Siswa/Guest --}}
                @else
                    <div class="news-card card border-0 shadow-lg rounded-4 overflow-hidden mb-5 user-news-item" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 100 }}"
                         data-aos-duration="800">
                        <div class="row g-0">
                            {{-- Gambar dengan Animasi --}}
                            @if($b->gambar)
                                <div class="col-md-5 position-relative image-container-user">
                                    <img src="{{ asset('storage/'.$b->gambar) }}" 
                                         class="img-fluid w-100 h-100 news-image-user" 
                                         alt="Gambar Berita"
                                         style="min-height: 280px; object-fit: cover;">
                                </div>
                            @endif

                            {{-- Konten dengan Animasi --}}
                            <div class="{{ $b->gambar ? 'col-md-7' : 'col-12' }}">
                                <div class="card-body d-flex flex-column justify-content-between h-100 p-4 p-lg-5 content-container-user">

                                    {{-- Info dengan Animasi --}}
                                    <div>
                                        <div class="d-flex align-items-center flex-wrap gap-4 mb-3 small text-muted info-meta-user">
                                            <div class="d-flex align-items-center meta-item-user" data-aos="fade-right" data-aos-delay="{{ $index * 100 + 200 }}">
                                                <i class="bi bi-calendar-event me-2 icon-muted"></i>
                                                <span style="font-family: 'Inter', sans-serif;">{{ $b->created_at->format('d F Y') }}</span>
                                            </div>
                                            <div class="d-flex align-items-center meta-item-user" data-aos="fade-right" data-aos-delay="{{ $index * 100 + 300 }}">
                                                <i class="bi bi-person-circle me-2 icon-muted"></i>
                                                <span style="font-family: 'Inter', sans-serif;">Admin</span>
                                            </div>
                                            <div class="d-flex align-items-center meta-item-user" data-aos="fade-right" data-aos-delay="{{ $index * 100 + 400 }}">
                                                <i class="bi bi-eye me-2 icon-muted"></i>
                                                <span style="font-family: 'Inter', sans-serif;">{{ $b->views ?? 0 }} kali dibaca</span>
                                            </div>
                                        </div>

                                        {{-- Judul & deskripsi dengan Animasi --}}
                                        <h3 class="card-title fw-bold text-dark mb-3 line-clamp-2 hover-title-user" 
                                            data-aos="fade-up" 
                                            data-aos-delay="{{ $index * 100 + 500 }}"
                                            style="font-family: 'Poppins', sans-serif;">
                                            {{ $b->judul }}
                                        </h3>
                                        <p class="card-text text-secondary mb-4 line-clamp-3 desc-user"
                                           data-aos="fade-up" 
                                           data-aos-delay="{{ $index * 100 + 600 }}"
                                           style="font-family: 'Inter', sans-serif;">
                                            {{ $b->deskripsi ?? Str::limit(strip_tags($b->isi), 200) }}
                                        </p>
                                    </div>

                                    {{-- Tombol Aksi dengan Animasi --}}
                                    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 border-top">
                                        {{-- Hanya tampilkan tombol "Baca Selengkapnya" untuk user yang sudah login --}}
                                        @auth
                                            <a href="{{ route('berita.show', $b->id) }}" 
                                               class="btn btn-success rounded-pill px-4 py-2 d-flex align-items-center gap-2 btn-hover-lift-user"
                                               data-aos="zoom-in" 
                                               data-aos-delay="{{ $index * 100 + 700 }}"
                                               style="font-family: 'Poppins', sans-serif;">
                                                <i class="bi bi-arrow-right-circle-fill btn-icon-user"></i> 
                                                <span class="btn-text-user">Baca Selengkapnya</span>
                                            </a>
                                        @endauth

                                        
                                        {{-- Likes & Comments: hanya tampil jika user sudah login --}}
                                        @auth
                                            <div class="d-flex gap-2 align-items-center">
                                                <form action="{{ route('berita.like', $b->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-outline-success btn-sm">
                                                        <i class="bi bi-hand-thumbs-up"></i> {{ $b->likes ?? 0 }}
                                                    </button>
                                                </form>

                                                <a href="{{ route('berita.show', $b->id) }}#comments" class="btn btn-outline-secondary btn-sm">
                                                    <i class="bi bi-chat-left-text"></i> {{ $b->comments_count ?? 0 }}
                                                </a>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Elements --}}
                        <div class="floating-circle-1"></div>
                        <div class="floating-circle-2"></div>
                    </div>
                @endif
            @empty
                {{-- Empty State dengan Animasi --}}
                <div class="text-center py-5 my-4" data-aos="fade-up" data-aos-duration="1000">
                    <div class="empty-icon mb-3" data-aos="bounce" data-aos-delay="200">
                        <i class="bi bi-newspaper display-1 text-muted"></i>
                    </div>
                    <h4 class="text-muted fw-bold mb-2" data-aos="fade-up" data-aos-delay="400" style="font-family: 'Poppins', sans-serif;">Belum Ada Berita</h4>
                    <p class="text-muted mb-4" data-aos="fade-up" data-aos-delay="600" style="font-family: 'Inter', sans-serif;">Belum ada berita yang ditambahkan.</p>
                    @if(in_array($role, ['admin','petugas']))
                        <a href="{{ route('berita.create') }}" 
                           class="btn btn-success btn-lg px-4 py-2 d-flex align-items-center gap-2 mx-auto" 
                           style="width: fit-content; font-family: 'Poppins', sans-serif;"
                           data-aos="zoom-in" 
                           data-aos-delay="800">
                            <i class="bi bi-plus-circle"></i> 
                            Buat Berita Pertama
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination dengan Animasi --}}
    @if(isset($berita) && $berita->hasPages())
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-8">
                <div class="bg-white rounded-3 p-3 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                    {{ $berita->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Fonts & AOS Animation Library -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<style>
/* Global Styles dengan Font Baru */
* {
    font-family: 'Inter', sans-serif;
}

/* small hover */
.user-news-item { transition: transform .18s ease, box-shadow .18s ease; }
.user-news-item:hover { transform: translateY(-6px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    if (window.AOS) AOS.init({ duration: 800, once: true, offset: 100 });

    // Card interactions
    document.querySelectorAll('.user-news-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
            const button = this.querySelector('.btn-hover-lift-user');
            if (button) button.style.background = 'linear-gradient(135deg, #146c43, #0f5132)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
            const button = this.querySelector('.btn-hover-lift-user');
            if (button) button.style.background = '';
        });
        item.addEventListener('click', function(e) {
            if (!e.target.closest('a') && !e.target.closest('button')) {
                const link = this.querySelector('a[href*="/berita/"]');
                if (link) window.location = link.getAttribute('href');
            }
        });
    });
});
</script>
@endsection