@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4 bg-light min-vh-100">

    {{-- ✨ Header Section --}}
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <div class="hero-section text-center animate-fade-in">
                {{-- Icon Berita Besar --}}
                <div class="news-icon-main mb-3">
                    <i class="bi bi-newspaper text-success"></i>
                </div>
                
                <h1 class="display-6 fw-bold text-success mb-2" style="font-family: 'Poppins', sans-serif;">
                    Berita Terkini UKS
                </h1>
                <p class="lead text-muted mb-4" style="font-family: 'Inter', sans-serif;">
                    @if(in_array(auth()->user()->role, ['admin','petugas']))
                        Kelola informasi dan berita untuk komunitas sekolah
                    @else
                        Informasi terbaru seputar kesehatan dari UKS SMKN 8 Jakarta
                    @endif
                </p>

                {{-- Action Buttons HANYA untuk Admin/Petugas --}}
                @if(in_array(auth()->user()->role, ['admin','petugas']))
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
                @if(in_array(auth()->user()->role, ['admin','petugas']))
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
                                                {{ $b->views }}x
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

                {{-- Tampilan untuk User/Siswa --}}
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
                                    <div class="image-overlay-user"></div>
                                    <div class="image-shine"></div>
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
                                                <span style="font-family: 'Inter', sans-serif;">{{ $b->views }} kali dibaca</span>
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
                                        <a href="{{ route('berita.show', $b->id ) }}" 
                                           class="btn btn-success rounded-pill px-4 py-2 d-flex align-items-center gap-2 btn-hover-lift-user"
                                           data-aos="zoom-in" 
                                           data-aos-delay="{{ $index * 100 + 700 }}"
                                           style="font-family: 'Poppins', sans-serif;">
                                            <i class="bi bi-arrow-right-circle-fill btn-icon-user"></i> 
                                            <span class="btn-text-user">Baca Selengkapnya</span>
                                        </a>
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
                    @if(in_array(auth()->user()->role, ['admin','petugas']))
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
    @if($berita->hasPages())
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

.bg-light {
    background-color: #f8f9fa !important;
}

/* Font untuk Heading */
h1, h2, h3, h4, h5, h6,
.news-title,
.card-title,
.fw-bold,
.btn {
    font-family: 'Poppins', sans-serif !important;
}

/* Font untuk Body Text */
p, span, small, .text-muted,
.news-desc, .card-text,
.form-label, .form-control {
    font-family: 'Inter', sans-serif !important;
}

/* News Icon Styles */
.news-icon-main {
    font-size: 4rem;
    opacity: 0.9;
}

.news-icon-main i {
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
}

.news-icon {
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.news-item:hover .news-icon {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(135deg, #198754, #146c43) !important;
}

/* ==================== */
/* STYLING UNTUK ADMIN/PETUGAS */
/* ==================== */

.news-item {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.news-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    border-left-color: #198754;
    background: white;
}

.news-title {
    font-size: 1.25rem;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.news-item:hover .news-title {
    color: #198754 !important;
}

.news-desc {
    line-height: 1.6;
    font-size: 0.95rem;
}

.news-meta small {
    background: rgba(108, 117, 125, 0.1);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.8rem;
}

.news-image-preview img {
    transition: transform 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.news-item:hover .news-image-preview img {
    transform: scale(1.02);
}

/* ==================== */
/* STYLING & ANIMASI UNTUK USER/SISWA */
/* ==================== */

.user-news-item {
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.user-news-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.8s ease;
}

.user-news-item:hover::before {
    left: 100%;
}

.user-news-item:hover {
    transform: translateY(-8px);
    box-shadow: 
        0 20px 40px rgba(0,0,0,0.12),
        0 0 0 1px rgba(25, 135, 84, 0.1);
}

/* Image Animations untuk User */
.image-container-user {
    position: relative;
    overflow: hidden;
}

.news-image-user {
    transition: all 0.6s ease;
    filter: brightness(0.95);
}

.user-news-item:hover .news-image-user {
    transform: scale(1.05);
    filter: brightness(1.05);
}

.image-overlay-user {
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, rgba(25, 135, 84, 0.1), rgba(108, 117, 125, 0.05));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.user-news-item:hover .image-overlay-user {
    opacity: 1;
}

.image-shine {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
    transform: rotate(45deg);
    transition: all 0.8s ease;
    opacity: 0;
}

.user-news-item:hover .image-shine {
    opacity: 1;
    transform: rotate(45deg) translate(20%, 20%);
}

/* Content Animations untuk User */
.content-container-user {
    position: relative;
    z-index: 2;
}

.info-meta-user .meta-item-user {
    transition: all 0.3s ease;
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    background: rgba(108, 117, 125, 0.08);
}

.meta-item-user:hover {
    background: rgba(25, 135, 84, 0.1);
    transform: translateY(-2px);
    color: #198754 !important;
}

.hover-title-user {
    position: relative;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #2c3e50, #34495e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.user-news-item:hover .hover-title-user {
    background: linear-gradient(135deg, #198754, #146c43);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transform: translateX(8px);
}

.desc-user {
    transition: all 0.4s ease;
}

.user-news-item:hover .desc-user {
    transform: translateX(5px);
    color: #495057 !important;
}

/* Button Animations untuk User */
.btn-hover-lift-user {
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    background: linear-gradient(135deg, #198754, #146c43);
    border: none;
    border-radius: 2rem !important;
}

.btn-hover-lift-user::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.btn-hover-lift-user:hover::before {
    left: 100%;
}

.btn-hover-lift-user:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 
        0 10px 25px rgba(25, 135, 84, 0.3),
        0 0 0 2px rgba(255,255,255,0.8);
}

.btn-icon-user {
    transition: transform 0.3s ease;
}

.btn-hover-lift-user:hover .btn-icon-user {
    transform: scale(1.2) rotate(10deg);
}

.btn-text-user {
    position: relative;
    z-index: 2;
}

/* Floating Elements */
.floating-circle-1,
.floating-circle-2 {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(25, 135, 84, 0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
    z-index: 1;
}

.floating-circle-1 {
    width: 80px;
    height: 80px;
    top: -20px;
    right: -20px;
    animation-delay: 0s;
}

.floating-circle-2 {
    width: 60px;
    height: 60px;
    bottom: -15px;
    left: -15px;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-15px) rotate(180deg);
        opacity: 1;
    }
}

/* Text Clamp */
.line-clamp-2, .line-clamp-3 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 { -webkit-line-clamp: 2; }
.line-clamp-3 { -webkit-line-clamp: 3; }

/* Empty State Animations */
.empty-icon {
    animation: bounce 2s ease-in-out infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-8px);
    }
    60% {
        transform: translateY(-4px);
    }
}

/* Button Styles */
.btn {
    transition: all 0.3s ease;
    border-radius: 0.5rem;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn-success {
    background: linear-gradient(135deg, #198754, #146c43);
    border: none;
}

.btn-outline-success {
    border-color: #198754;
    color: #198754;
}

.btn-outline-success:hover {
    background: #198754;
    color: white;
}

/* Animasi untuk semua role */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

.animate-slide-up {
    animation: slideUp 0.6s ease-out forwards;
    opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .user-news-item:hover {
        transform: translateY(-5px);
    }
    
    .floating-circle-1,
    .floating-circle-2 {
        display: none;
    }
    
    .news-item .row {
        flex-direction: column;
        text-align: center;
    }
    
    .news-icon {
        margin: 0 auto 1rem auto;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Additional hover effects untuk user
    const userNewsItems = document.querySelectorAll('.user-news-item');
    
    userNewsItems.forEach(item => {
        // Mouse enter effect
        item.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
            const button = this.querySelector('.btn-hover-lift-user');
            if (button) {
                button.style.background = 'linear-gradient(135deg, #146c43, #0f5132)';
            }
        });
        
        // Mouse leave effect
        item.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
            const button = this.querySelector('.btn-hover-lift-user');
            if (button) {
                button.style.background = 'linear-gradient(135deg, #198754, #146c43)';
            }
        });
        
        // Click effect
        item.addEventListener('click', function(e) {
            if (!e.target.closest('a') && !e.target.closest('button')) {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            }
        });
    });
});
</script>
@endsection