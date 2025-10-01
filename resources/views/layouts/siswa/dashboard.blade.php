@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary display-5">Selamat Datang di UKS SMKN 8 Jakarta</h1>
        <p class="text-muted fs-5">
            UKS hadir untuk memberikan layanan kesehatan dasar, edukasi, 
            dan pertolongan pertama bagi siswa SMKN 8 Jakarta.
        </p>
    </div>

    <!-- Row Cards -->
    <div class="row g-4 justify-content-center">
        <!-- Riwayat -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3 text-primary">📋</div>
                    <h5 class="card-title fw-bold">Riwayat Kunjungan</h5>
                    <p class="card-text text-muted small">
                        Lihat catatan kunjungan UKS yang pernah kamu lakukan.
                    </p>
                </div>
                <div class="card-footer bg-light border-0 text-center">
                    <form action="{{ route('siswa.riwayat') }}" method="GET">
                        <button type="submit" class="btn btn-primary w-100">
                            Lihat Riwayat
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Obat -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3 text-success">💊</div>
                    <h5 class="card-title fw-bold">Daftar Obat</h5>
                    <p class="card-text text-muted small">
                        Informasi mengenai obat-obatan yang tersedia di UKS.
                    </p>
                </div>
                <div class="card-footer bg-light border-0 text-center">
                    <form action="{{ route('obat.index') }}" method="GET">
                        <button type="submit" class="btn btn-success w-100">
                            Lihat Obat
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Berita -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3 text-warning">📰</div>
                    <h5 class="card-title fw-bold">Berita Kesehatan</h5>
                    <p class="card-text text-muted small">
                        Dapatkan berita terbaru & informasi seputar kesehatan sekolah.
                    </p>
                </div>
                <div class="card-footer bg-light border-0 text-center">
                    <form action="{{ route('berita.index') }}" method="GET">
                        <button type="submit" class="btn btn-warning w-100 text-white">
                            Baca Berita
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Container Baru untuk Visi Misi -->
<div class="container py-5" id="visi-misi">
    <div class="card shadow-lg border-0 p-4 bg-light">
        <div class="row align-items-center">
            <!-- Visi -->
            <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="fw-bold text-primary mb-3">🌟 Visi</h3>
                <p class="text-muted fs-6">
                    Menjadi UKS yang unggul dalam memberikan pelayanan kesehatan, 
                    meningkatkan kesadaran hidup sehat, serta mendukung 
                    terciptanya lingkungan sekolah yang sehat, aman, dan nyaman.
                </p>
            </div>

            <!-- Misi -->
            <div class="col-md-6">
                <h3 class="fw-bold text-success mb-3">🎯 Misi</h3>
                <ul class="list-group list-group-flush shadow-sm rounded">
                    <li class="list-group-item">💡 Memberikan pertolongan pertama pada siswa yang sakit di sekolah.</li>
                    <li class="list-group-item">📚 Mengedukasi siswa tentang pola hidup bersih dan sehat.</li>
                    <li class="list-group-item">🤝 Membangun kerjasama dengan pihak sekolah & puskesmas.</li>
                    <li class="list-group-item">🌱 Menciptakan lingkungan sekolah yang sehat dan nyaman.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animasi hover */
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }

    .hover-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
    }

    .hover-card .card-body .display-4 {
        transition: transform 0.3s ease;
    }

    .hover-card:hover .card-body .display-4 {
        transform: rotate(5deg) scale(1.2);
    }

    #visi-misi .card {
        border-radius: 16px;
    }

    #visi-misi ul li {
        font-size: 0.95rem;
        padding: 10px 15px;
    }

    #visi-misi ul li:hover {
        background-color: #f8f9fa;
        transition: background 0.3s ease;
    }
</style>
@endsection
