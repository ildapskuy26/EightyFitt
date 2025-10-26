@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    {{-- Hero Section dengan Parallax --}}
    @if($berita->gambar)
    <section class="hero-section position-relative overflow-hidden">
        <div class="parallax-wrapper">
            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                 class="parallax-image"
                 alt="gambar berita">
            <div class="parallax-overlay"></div>
        </div>
        <div class="hero-content position-relative vh-100 d-flex align-items-end">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="hero-text animate-fade-in">
                            <div class="news-badge mb-4">
                                <span class="badge bg-primary bg-opacity-20 text-white border border-primary border-opacity-25 px-3 py-2 rounded-pill">
                                    <i class="bi bi-megaphone me-2"></i>Berita Terkini
                                </span>
                            </div>
                            <h1 class="hero-title display-3 fw-bold text-white mb-4 text-shadow-lg">
                                {{ $berita->judul }}
                            </h1>
                            <div class="hero-meta d-flex flex-wrap gap-4 text-white opacity-90">
                                <div class="meta-item d-flex align-items-center">
                                    <div class="meta-icon bg-primary bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="bi bi-calendar2-event"></i>
                                    </div>
                                    <div>
                                        <div class="meta-label small opacity-75">Diterbitkan</div>
                                        <div class="fw-semibold">{{ $berita->created_at->format('d F Y') }}</div>
                                    </div>
                                </div>
                                <div class="meta-item d-flex align-items-center">
                                    <div class="meta-icon bg-primary bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <div>
                                        <div class="meta-label small opacity-75">Penulis</div>
                                        <div class="fw-semibold">Admin</div>
                                    </div>
                                </div>
                                <div class="meta-item d-flex align-items-center">
                                    <div class="meta-icon bg-primary bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div>
                                        <div class="meta-label small opacity-75">Waktu Baca</div>
                                        <div class="fw-semibold">5 menit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>
    @endif

    {{-- Main Content --}}
    <main class="main-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    
                    {{-- Header untuk tanpa gambar --}}
                    @if(!$berita->gambar)
                    <div class="text-center mb-5 py-5">
                        <div class="news-badge mb-4">
                            <span class="badge bg-gradient-primary text-white px-4 py-2 rounded-pill">
                                <i class="bi bi-megaphone me-2"></i>Berita Terkini
                            </span>
                        </div>
                        <h1 class="display-3 fw-bold text-gradient mb-4">{{ $berita->judul }}</h1>
                        <div class="d-flex flex-wrap justify-content-center gap-5 text-muted">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-calendar2-event text-primary"></i>
                                </div>
                                <div>
                                    <div class="small opacity-75">Diterbitkan</div>
                                    <div class="fw-semibold">{{ $berita->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-person-circle text-primary"></i>
                                </div>
                                <div>
                                    <div class="small opacity-75">Penulis</div>
                                    <div class="fw-semibold">Admin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Deskripsi singkat --}}
                    @if(!empty($berita->deskripsi))
                    <div class="highlight-box bg-gradient-primary text-white rounded-4 p-4 p-md-5 mb-5 shadow-lg animate-slide-up">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-quote fs-1 me-4 opacity-50"></i>
                            <p class="mb-0 fs-5 lh-lg fst-italic">{{ $berita->deskripsi }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Isi berita --}}
                    <article class="article-content mb-5">
                        <div class="content-body animate-fade-in" data-delay="200">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>
                    </article>

                </div>
            </div>
        </div>
    </main>

     {{-- === Bagian Like === --}}
                    <div class="d-flex align-items-center justify-content-between my-4 p-3 rounded-4 shadow-sm bg-light border border-1">
                        <form action="{{ route('berita.like', $berita->id) }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" 
                                class="btn btn-outline-danger d-flex align-items-center gap-2 px-4 py-2 rounded-pill fw-semibold hover-scale">
                                <i class="bi bi-heart-fill fs-5"></i>
                                <span>{{ $berita->likes->count() }} Suka</span>
                            </button>
                        </form>

                        <div class="text-muted small d-flex align-items-center gap-2">
                            <i class="bi bi-eye-fill"></i>
                            <span>{{ $berita->views ?? 0 }} kali dibaca</span>
                        </div>
                    </div>

                    {{-- === Bagian Komentar === --}}
                    <div class="comments mt-5">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-chat-dots-fill text-primary fs-3 me-2"></i>
                            <h4 class="m-0 fw-bold">Komentar ({{ $berita->comments->count() }})</h4>
                        </div>

                        {{-- Form komentar --}}
                        <form action="{{ route('berita.comment', $berita->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="input-group">
                                <textarea name="isi" rows="2" class="form-control shadow-sm rounded-start-4" placeholder="Tulis komentar kamu..."></textarea>
                                <button class="btn btn-primary rounded-end-4 px-4 d-flex align-items-center gap-2 fw-semibold">
                                    <i class="bi bi-send-fill"></i>
                                    Kirim
                                </button>
                            </div>
                        </form>

                        {{-- Daftar komentar --}}
                        @forelse($berita->comments()->latest()->get() as $comment)
                            <div class="border rounded-4 p-3 mb-3 bg-white shadow-sm comment-box">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong class="text-dark">{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0 text-secondary">{{ $comment->isi }}</p>
                            </div>
                        @empty
                            <p class="text-muted fst-italic">Belum ada komentar. Jadilah yang pertama!</p>
                        @endforelse
                    </div>



    {{-- Related News --}}
    <section class="related-news py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section-header text-center mb-5">
                        <h2 class="display-5 fw-bold text-gradient mb-3">Berita Terbaru Lainnya</h2>
                        <p class="text-muted fs-5">Simak berita menarik lainnya dari kami</p>
                    </div>
                    
                    <div class="row g-4">
                        @php
                            // Ambil 3 berita terbaru selain berita yang sedang dilihat
                            $relatedNews = \App\Models\Berita::where('id', '!=', $berita->id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();
                        @endphp

                        @if($relatedNews->count() > 0)
                            @foreach($relatedNews as $related)
                            <div class="col-md-4">
                                <div class="news-card card border-0 shadow-sm h-100 rounded-4 overflow-hidden transition-all">
                                    <div class="card-image position-relative overflow-hidden">
                                        @if($related->gambar)
                                            <img src="{{ asset('storage/' . $related->gambar) }}" 
                                                 class="w-100 h-100" 
                                                 style="object-fit: cover; height: 200px;"
                                                 alt="{{ $related->judul }}">
                                        @else
                                            <div class="placeholder-image bg-gradient-{{ ['primary','success','warning'][$loop->index] }} w-100 h-100"></div>
                                        @endif
                                        <div class="card-overlay"></div>
                                        <div class="card-badge position-absolute top-0 start-0 m-3">
                                            <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
                                                <i class="bi bi-clock me-1"></i>
                                                @php
                                                    $diff = $related->created_at->diffForHumans();
                                                    $diff = str_replace(['seconds', 'second', 'minutes', 'minute', 'hours', 'hour', 'days', 'day', 'weeks', 'week', 'months', 'month', 'years', 'year'], ['detik', 'detik', 'menit', 'menit', 'jam', 'jam', 'hari', 'hari', 'minggu', 'minggu', 'bulan', 'bulan', 'tahun', 'tahun'], $diff);
                                                @endphp
                                                {{ $diff }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-bold mb-3 line-clamp-2" style="min-height: 3rem;">
                                            {{ Str::limit($related->judul, 60) }}
                                        </h5>
                                        <p class="card-text text-muted mb-4 line-clamp-3" style="min-height: 4.5rem;">
                                            {{ Str::limit($related->deskripsi ?? $related->isi, 120) }}
                                        </p>
                                        <div class="card-meta d-flex align-items-center justify-content-between">
                                            <a href="{{ route('berita.show', $related) }}" class="text-primary fw-semibold text-decoration-none">
                                                Baca Selengkapnya
                                            </a>
                                            <i class="bi bi-arrow-right text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            {{-- Fallback jika tidak ada berita terkait --}}
                            @for($i = 0; $i < 3; $i++)
                            <div class="col-md-4">
                                <div class="news-card card border-0 shadow-sm h-100 rounded-4 overflow-hidden transition-all">
                                    <div class="card-image position-relative overflow-hidden">
                                        <div class="placeholder-image bg-gradient-{{ ['primary','success','warning'][$i] }}"></div>
                                        <div class="card-overlay"></div>
                                        <div class="card-badge position-absolute top-0 start-0 m-3">
                                            <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
                                                <i class="bi bi-clock me-1"></i>2 jam lalu
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-bold mb-3">Belum ada berita lainnya</h5>
                                        <p class="card-text text-muted mb-4">Admin belum membuat berita lainnya saat ini.</p>
                                        <div class="card-meta d-flex align-items-center justify-content-between">
                                            <span class="text-muted fw-semibold">Tidak tersedia</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                    
                    
                        
                        {{-- Action Buttons --}}
                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center align-items-center mt-4">
                            <a href="{{ route('berita.index') }}" 
                               class="btn btn-outline-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2">
                                <i class="bi bi-arrow-left"></i>
                                <span>Kembali ke Daftar Berita</span>
                            </a>
                            
                            @auth
                            @if(in_array(auth()->user()->role, ['admin','petugas']))
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('berita.edit', $berita) }}" 
                                   class="btn btn-warning text-white rounded-pill px-4 py-2 d-flex align-items-center gap-2">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Edit Berita</span>
                                </a>
                                <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger rounded-pill px-4 py-2 d-flex align-items-center gap-2"
                                            onclick="return confirm('Hapus berita ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                        <span>Hapus Berita</span>
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Premium CSS --}}
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    /* Hero Section */
    .hero-section {
        height: 100vh;
    }

    .parallax-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .parallax-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    .parallax-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
    }

    .hero-content {
        z-index: 2;
        padding-bottom: 100px;
    }

    .hero-title {
        line-height: 1.2;
    }

    .text-shadow-lg {
        text-shadow: 0 4px 8px rgba(0,0,0,0.5);
    }

    /* Animations */
    .animate-fade-in {
        animation: fadeInUp 1s ease-out;
    }

    .animate-slide-up {
        animation: slideUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
    }

    .scroll-arrow {
        width: 30px;
        height: 30px;
        border-right: 2px solid white;
        border-bottom: 2px solid white;
        transform: rotate(45deg);
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: rotate(45deg) translateY(0); }
        50% { transform: rotate(45deg) translateY(-10px); }
    }

    /* Text Gradient */
    .text-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bg-gradient-primary {
        background: var(--primary-gradient) !important;
    }

    .bg-gradient-success {
        background: var(--success-gradient) !important;
    }

    .bg-gradient-warning {
        background: var(--warning-gradient) !important;
    }

    /* Components */
    .highlight-box {
        border-left: 4px solid rgba(255,255,255,0.3);
    }

    .news-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .news-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .news-card:hover .card-meta i {
        transform: translateX(5px);
    }

    .card-image {
        height: 200px;
    }

    .placeholder-image {
        width: 100%;
        height: 100%;
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.1) 100%);
    }

    /* Line clamp utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Content Styling */
    .content-body {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #2d3748;
    }

    .content-body p {
        margin-bottom: 1.5rem;
    }

    .content-body strong {
        color: #1a202c;
        font-weight: 600;
    }

    /* Transitions */
    .transition-all {
        transition: all 0.3s ease;
    }

    .card-meta i {
        transition: transform 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem !important;
        }
        
        .display-3 {
            font-size: 2rem !important;
        }
        
        .hero-meta {
            flex-direction: column;
            gap: 1rem !important;
        }
        
        .action-section .row > div {
            text-align: center !important;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2rem !important;
        }
        
        .display-3 {
            font-size: 1.75rem !important;
        }
        
        .hero-content {
            padding-bottom: 60px;
        }
    }
</style>

{{-- JavaScript untuk efek paralax --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Parallax effect
    const parallax = document.querySelector('.parallax-image');
    if (parallax) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            parallax.style.transform = `scale(1.1) translateY(${rate}px)`;
        });
    }

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe animated elements
    document.querySelectorAll('.animate-fade-in, .animate-slide-up').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
});
</script>
@endsection