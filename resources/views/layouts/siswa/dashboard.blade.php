@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section d-flex align-items-center animate-on-scroll">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text -->
            <div class="col-md-7 animate-on-scroll">
                <h1 class="fw-bold display-4 mb-4 text-gradient">
                    Jaga Kesehatan<br>Bersama UKS
                </h1>
                <p class="fs-5 mb-4 text-secondary">
                    Tempat layanan pemeriksaan, edukasi, dan bantuan kesehatan bagi seluruh siswa.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('berita.index') }}" class="btn btn-pink btn-lg px-4 shadow-sm">Berita</a>
                    <a href="{{ route('kontak.index') }}" class="btn btn-outline-primary btn-lg px-4 shadow-sm">Kontak Kami</a>
                </div>
            </div>

            <!-- Image -->
            <div class="col-md-5 text-center mt-4 mt-md-0 animate-on-scroll">
                <img src="{{ asset('images/hero.png') }}" alt="Hero Image"
                     class="img-fluid animate-float" style="background: transparent; box-shadow: none;">
            </div>
        </div>
    </div>
</div>

<!-- Section Cards -->
<div class="container py-5 animate-on-scroll">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 text-gradient">Selamat Datang di UKS SMKN 8 Jakarta</h1>
        <p class="text-muted fs-5">
            UKS hadir untuk memberikan layanan kesehatan dasar, edukasi,
            dan pertolongan pertama bagi siswa SMKN 8 Jakarta.
        </p>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Riwayat -->
        <div class="col-md-6 col-lg-4 animate-on-scroll">
            <div class="card h-100 shadow-sm border-0 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3 text-primary">📋</div>
                    <h5 class="card-title fw-bold">Riwayat Kunjungan</h5>
                    <p class="card-text text-muted small">
                        Lihat catatan kunjungan UKS yang pernah kamu lakukan.
                    </p>
                </div>
                <div class="card-footer bg-white border-0 text-center">
                    <form action="{{ route('siswa.riwayat') }}" method="GET">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">
                            Lihat Riwayat
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Obat -->
        <div class="col-md-6 col-lg-4 animate-on-scroll">
            <div class="card h-100 shadow-sm border-0 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3 text-success">💊</div>
                    <h5 class="card-title fw-bold">Daftar Obat</h5>
                    <p class="card-text text-muted small">
                        Informasi mengenai obat-obatan yang tersedia di UKS.
                    </p>
                </div>
                <div class="card-footer bg-white border-0 text-center">
                    <form action="{{ route('obat.index') }}" method="GET">
                        <button type="submit" class="btn btn-success w-100 shadow-sm">
                            Lihat Obat
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Berita -->
        <div class="col-md-6 col-lg-4 animate-on-scroll">
            <div class="card h-100 shadow-sm border-0 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3 text-warning">📰</div>
                    <h5 class="card-title fw-bold">Berita Kesehatan</h5>
                    <p class="card-text text-muted small">
                        Dapatkan berita terbaru & informasi seputar kesehatan sekolah.
                    </p>
                </div>
                <div class="card-footer bg-white border-0 text-center">
                    <form action="{{ route('berita.index') }}" method="GET">
                        <button type="submit" class="btn btn-warning w-100 text-white shadow-sm">
                            Baca Berita
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Visi Misi Section -->
<div class="container py-5 animate-on-scroll" id="visi-misi">
    <div class="card shadow-lg border-0 p-4 bg-light rounded-4">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="fw-bold text-gradient mb-3">🌟 Visi</h3>
                <p class="text-muted fs-6">
                    Menjadi UKS yang unggul dalam memberikan pelayanan kesehatan,
                    meningkatkan kesadaran hidup sehat, serta mendukung
                    terciptanya lingkungan sekolah yang sehat, aman, dan nyaman.
                </p>
            </div>

            <div class="col-md-6">
                <h3 class="fw-bold text-success mb-3">🎯 Misi</h3>
                <ul class="list-group list-group-flush rounded shadow-sm">
                    <li class="list-group-item">💡 Memberikan pertolongan pertama pada siswa yang sakit di sekolah.</li>
                    <li class="list-group-item">📚 Mengedukasi siswa tentang pola hidup bersih dan sehat.</li>
                    <li class="list-group-item">🤝 Membangun kerjasama dengan pihak sekolah & puskesmas.</li>
                    <li class="list-group-item">🌱 Menciptakan lingkungan sekolah yang sehat dan nyaman.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles & Animations -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; }

    .text-gradient {
        background: linear-gradient(90deg, #00b894, #0984e3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-pink {
        background-color: #ff6b81;
        color: white;
        border-radius: 50px;
        transition: 0.3s;
    }
    .btn-pink:hover {
        background-color: #ff4757;
        transform: translateY(-2px);
    }

    .hover-card {
        transition: transform 0.4s ease, box-shadow 0.3s ease;
        border-radius: 14px;
    }
    .hover-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
        100% { transform: translateY(0); }
    }

    /* Scroll reveal effect */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s ease-out;
    }

    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }

    #visi-misi ul li:hover {
        background-color: #f8f9fa;
        transition: background 0.3s ease;
    }
</style>

<!-- Scroll Animation Script -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const elements = document.querySelectorAll(".animate-on-scroll");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        }, { threshold: 0.15 });

        elements.forEach(el => observer.observe(el));
    });
</script>
@endsection
