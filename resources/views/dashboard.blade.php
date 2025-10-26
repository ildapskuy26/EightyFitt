@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<div id="hero" class="hero-section d-flex align-items-center justify-content-center text-center position-relative">
    <!-- Overlay lembut transparan -->
    <div class="hero-overlay"></div>

    <div class="container position-relative z-1 py-0 my-0">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <!-- TEKS UTAMA -->
                <h1 class="hero-title mb-1">
                    Sehat Itu Gaya Hidup,
                </h1>

                <h1 class="hero-title mb-3">
                    Yuk Mulai 
                    <span class="highlight-text">
                        Dari Sekolah!
                    </span>
                </h1>

                <p class="fs-5 text-secondary mb-3 hero-subtitle" style="max-width: 700px; margin: 0 auto;">
                    Bersama UKS SMKN 8 Jakarta, wujudkan lingkungan sekolah yang sehat, bersih, dan nyaman.
                </p>

                <div class="d-flex justify-content-center gap-3 mt-4 hero-buttons flex-wrap">
                    <!-- Tombol Berita hijau -->
                    <a href="{{ route('berita.index') }}" 
                       class="btn btn-hero px-5 py-2 fw-semibold shadow-sm mb-2">
                       <i class="fas fa-newspaper me-2"></i>Berita
                    </a>
                    <!-- Tombol Kontak -->
                    <a href="{{ route('kontak.index') }}" 
                       class="btn btn-hero-outline px-5 py-2 fw-semibold shadow-sm mb-2">
                       <i class="fas fa-envelope me-2"></i>Kontak Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Icons Animation -->
    <div class="floating-icons">
        <div class="floating-icon icon-1">🏥</div>
        <div class="floating-icon icon-2">❤️</div>
        <div class="floating-icon icon-3">💊</div>
        <div class="floating-icon icon-4">🩺</div>
        <div class="floating-icon icon-5">🌿</div>
    </div>

    <!-- Scroll down indicator -->
    <div class="scroll-down-indicator">
        <div class="chevron"></div>
        <div class="chevron"></div>
        <div class="chevron"></div>
    </div>
</div>


<!-- SECTION RIWAYAT KUNJUNGAN YANG DIPERBAIKI -->
@auth
@if(auth()->user()->nis)
@if(Auth::user()->role == 'siswa')
<section id="visit-history" class="section-fade py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-info mx-auto mb-3">
                <i class="fas fa-history"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Riwayat Kunjungan Kamu</h2>
            <p class="text-muted" style="max-width: 700px; margin: auto;">
                Catatan lengkap kunjungan kamu ke UKS SMKN 8 Jakarta untuk mendapatkan layanan kesehatan.
            </p>
        </div>

        @if($riwayat->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state animate-on-scroll">
                <div class="empty-icon mb-4">
                    <i class="fas fa-clipboard-list fa-4x text-muted"></i>
                </div>
                <h4 class="fw-semibold text-dark mb-3">Belum Ada Riwayat Kunjungan</h4>
                <p class="text-muted mb-4">Kamu belum pernah mengunjungi UKS untuk mendapatkan layanan kesehatan.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="#" class="btn btn-hero px-4 py-2 fw-semibold">
                        <i class="fas fa-first-aid me-2"></i>Butuh Bantuan?
                    </a>
                    <a href="{{ route('berita.index') }}" class="btn btn-hero-outline px-4 py-2 fw-semibold">
                        <i class="fas fa-newspaper me-2"></i>Baca Tips Sehat
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate-on-scroll">
                    <div class="card-header bg-primary text-white py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="fw-bold mb-0">
                                    <i class="fas fa-list-ul me-2"></i>
                                    Daftar Kunjungan
                                </h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <span class="badge bg-light text-primary fs-6 p-2">
                                    Total: {{ $riwayat->count() }} Kunjungan
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center py-3 fw-semibold">No</th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-calendar me-2 text-primary"></i>
                                            Tanggal & Waktu
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-comment-medical me-2 text-success"></i>
                                            Keluhan
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-pills me-2 text-warning"></i>
                                            Obat Diberikan
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-user-md me-2 text-info"></i>
                                            Petugas
                                        </th>
                                        <th class="text-center py-3 fw-semibold">
                                            <i class="fas fa-cogs me-2 text-secondary"></i>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $index => $r)
                                    <tr class="visit-row animate-on-scroll">
                                        <td class="text-center fw-bold text-primary align-middle">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold text-dark">
                                                    {{ \Carbon\Carbon::parse($r->waktu_kedatangan)->format('d M Y') }}
                                                </span>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($r->waktu_kedatangan)->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @if($r->keluhan)
                                                <span class="keluhan-text">{{ $r->keluhan }}</span>
                                            @else
                                                <span class="text-muted fst-italic">-</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($r->obat && $r->obat->nama)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-pills text-warning me-2"></i>
                                                    <span class="obat-text">{{ $r->obat->nama }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted fst-italic">-</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($r->petugas && $r->petugas->name)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-md text-info me-2"></i>
                                                    <span>{{ $r->petugas->name }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted fst-italic">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge status-badge bg-success rounded-pill px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Selesai
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Data diperbarui secara real-time
                                </small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted">
                                    Terakhir diupdate: {{ now()->format('d M Y, H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- STATISTIK KUNJUNGAN -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="stat-card card border-0 shadow-sm rounded-4 text-center p-4 animate-on-scroll">
                            <div class="stat-icon text-primary mb-3">
                                <i class="fas fa-calendar-check fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-2">{{ $riwayat->count() }}</h3>
                            <p class="text-muted mb-0">Total Kunjungan</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card card border-0 shadow-sm rounded-4 text-center p-4 animate-on-scroll">
                            <div class="stat-icon text-success mb-3">
                                <i class="fas fa-pills fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-2">
                                {{ $riwayat->where('obat_id', '!=', null)->count() }}
                            </h3>
                            <p class="text-muted mb-0">Dengan Obat</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card card border-0 shadow-sm rounded-4 text-center p-4 animate-on-scroll">
                            <div class="stat-icon text-info mb-3">
                                <i class="fas fa-user-md fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-2">
                                {{ $riwayat->unique('petugas_id')->count() }}
                            </h3>
                            <p class="text-muted mb-0">Petugas Berbeda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endif
@endif
@endauth

<!-- SECTION TENTANG UKS -->
<section id="about-uks" class="section-fade">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-wrapper bg-primary me-3">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-0">Kenapa Ada UKS di Sekolah?</h2>
                </div>
                <p class="text-muted fs-6 mb-4">
                    Unit Kesehatan Sekolah (UKS) hadir untuk memberikan edukasi kesehatan yang mudah, 
                    seru, dan bisa dipraktikkan langsung dalam kehidupan sehari-hari di lingkungan sekolah.
                </p>
                
                <div class="d-flex align-items-start mb-3 animate-on-scroll">
                    <div class="flex-shrink-0">
                        <div class="icon-small bg-success">
                            <i class="fas fa-first-aid"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-semibold text-dark">Layanan Kesehatan Dasar</h5>
                        <p class="text-muted small mb-0">Pertolongan pertama dan pemeriksaan kesehatan rutin untuk siswa.</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-3 animate-on-scroll">
                    <div class="flex-shrink-0">
                        <div class="icon-small bg-info">
                            <i class="fas fa-book-medical"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-semibold text-dark">Edukasi Kesehatan</h5>
                        <p class="text-muted small mb-0">Materi hidup sehat yang disampaikan dengan cara menyenangkan dan mudah dipahami.</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3 animate-on-scroll">
                    <div class="flex-shrink-0">
                        <div class="icon-small bg-warning">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-semibold text-dark">Konsultasi Kesehatan</h5>
                        <p class="text-muted small mb-0">Konsultasi masalah kesehatan dengan petugas UKS yang berpengalaman.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-on-scroll">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-center mb-4">
                            <i class="fas fa-clipboard-list me-2 text-primary"></i>
                            Fasilitas UKS Kami
                        </h4>
                        
                        <div class="row text-center">
                            <div class="col-6 mb-4">
                                <div class="p-3 facility-item">
                                    <div class="facility-icon text-primary mb-2">
                                        <i class="fas fa-band-aid"></i>
                                    </div>
                                    <h6 class="fw-semibold">P3K Lengkap</h6>
                                    <p class="text-muted small">Peralatan pertolongan pertama yang lengkap</p>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="p-3 facility-item">
                                    <div class="facility-icon text-success mb-2">
                                        <i class="fas fa-pills"></i>
                                    </div>
                                    <h6 class="fw-semibold">Obat-obatan</h6>
                                    <p class="text-muted small">Obat dasar untuk penanganan darurat</p>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="p-3 facility-item">
                                    <div class="facility-icon text-info mb-2">
                                        <i class="fas fa-stethoscope"></i>
                                    </div>
                                    <h6 class="fw-semibold">Konsultasi</h6>
                                    <p class="text-muted small">Konsultasi kesehatan dengan petugas</p>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="p-3 facility-item">
                                    <div class="facility-icon text-warning mb-2">
                                        <i class="fas fa-running"></i>
                                    </div>
                                    <h6 class="fw-semibold">Aktivitas Sehat</h6>
                                    <p class="text-muted small">Program olahraga dan aktivitas sehat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION MASALAH KESEHATAN DI SEKOLAH -->
<section id="health-issues" class="bg-light py-5 section-fade">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-danger mx-auto mb-3">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="fw-bold text-dark">Masalah Kesehatan di Lingkungan Sekolah</h2>
            <p class="text-muted" style="max-width: 700px; margin: auto;">
                Berbagai tantangan kesehatan yang sering ditemui di lingkungan sekolah dan bagaimana UKS membantu mengatasinya.
            </p>
        </div>

        <div class="row g-4">
            <!-- PENYAKIT MENULAR -->
            <div class="col-md-4">
                <div class="health-card card border-0 shadow-sm rounded-4 h-100 text-center p-4 animate-on-scroll">
                    <div class="virus-animation mb-3">
                        <div class="issue-icon text-danger">
                            <i class="fas fa-virus"></i>
                        </div>
                        <div class="floating-virus virus-1">🦠</div>
                        <div class="floating-virus virus-2">🦠</div>
                        <div class="floating-virus virus-3">🦠</div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Penyakit Menular</h5>
                    <p class="text-muted">
                        Flu, batuk, dan penyakit menular lainnya mudah menyebar di lingkungan sekolah yang padat.
                    </p>
                    <div class="pulse-indicator"></div>
                </div>
            </div>
            
            <!-- CEDERA OLAHRAGA -->
            <div class="col-md-4">
                <div class="health-card card border-0 shadow-sm rounded-4 h-100 text-center p-4 animate-on-scroll">
                    <div class="injury-animation mb-3">
                        <div class="issue-icon text-warning">
                            <i class="fas fa-bone-break"></i>
                        </div>
                        <div class="running-figure">🏃</div>
                        <div class="bandage bandage-1">🩹</div>
                        <div class="bandage bandage-2">🩹</div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Cedera Olahraga</h5>
                    <p class="text-muted">
                        Cedera saat pelajaran olahraga atau aktivitas fisik membutuhkan penanganan segera.
                    </p>
                    <div class="heartbeat-line"></div>
                </div>
            </div>
            
            <!-- KELELAHAN MENTAL -->
            <div class="col-md-4">
                <div class="health-card card border-0 shadow-sm rounded-4 h-100 text-center p-4 animate-on-scroll">
                    <div class="mental-animation mb-3">
                        <div class="issue-icon text-info">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="thought-bubble bubble-1">💭</div>
                        <div class="thought-bubble bubble-2">💭</div>
                        <div class="thought-bubble bubble-3">💭</div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Kelelahan Mental</h5>
                    <p class="text-muted">
                        Stres akademik dan tekanan belajar dapat mempengaruhi kesehatan mental siswa.
                    </p>
                    <div class="brain-wave"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION EDUKASI YANG MUDAH & SERU -->
<section id="fun-education" class="section-fade">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="card border-0 shadow-sm rounded-4 p-4 animate-on-scroll">
                    <h3 class="fw-bold text-center mb-4">
                        <i class="fas fa-graduation-cap me-2 text-success"></i>
                        Edukasi yang Mudah & Seru
                    </h3>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="flex-shrink-0">
                            <div class="icon-small bg-success">
                                <i class="fas fa-bullseye"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold text-dark">Materi Praktis</h5>
                            <p class="text-muted small">Belajar hidup sehat dengan cara yang mudah dipahami dan langsung bisa dipraktikkan.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="flex-shrink-0">
                            <div class="icon-small bg-primary">
                                <i class="fas fa-gamepad"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold text-dark">Metode Menyenangkan</h5>
                            <p class="text-muted small">Games, kuis, dan aktivitas interaktif membuat belajar kesehatan jadi seru.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="flex-shrink-0">
                            <div class="icon-small bg-warning">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold text-dark">Belajar Bersama</h5>
                            <p class="text-muted small">Diskusi kelompok dan sharing session dengan teman-teman sekelas.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-wrapper bg-success me-3">
                        <i class="fas fa-laugh-beam"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-0">Edukasi Kesehatan yang Menyenangkan</h2>
                </div>
                <p class="text-muted mb-4">
                    Kami percaya bahwa edukasi kesehatan harus disampaikan dengan cara yang menyenangkan dan mudah dipahami. 
                    Melalui berbagai aktivitas interaktif, siswa dapat belajar tentang pentingnya menjaga kesehatan dengan cara yang seru.
                </p>
                <div class="row text-center">
                    <div class="col-4">
                        <div class="p-3 education-item">
                            <div class="education-icon text-success mb-2">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h6 class="fw-semibold">Pemantauan</h6>
                            <p class="text-muted small">Kesehatan rutin</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 education-item">
                            <div class="education-icon text-primary mb-2">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <h6 class="fw-semibold">Edukasi</h6>
                            <p class="text-muted small">Materi kesehatan</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 education-item">
                            <div class="education-icon text-warning mb-2">
                                <i class="fas fa-star"></i>
                            </div>
                            <h6 class="fw-semibold">Aktivitas</h6>
                            <p class="text-muted small">Program sehat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION PARTNERS & AWARDS -->
<section id="partners-awards" class="section-fade bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-info mx-auto mb-3">
                <i class="fas fa-trophy"></i>
            </div>
            <h2 class="fw-bold text-dark">Pencapaian & Partner Kami</h2>
            <p class="text-muted" style="max-width: 700px; margin: auto;">
                Prestasi yang telah diraih dan dukungan dari brand-brand terkemuka yang peduli lingkungan dalam menciptakan dunia yang lebih hijau dan berkelanjutan.
            </p>
        </div>

        <div class="row g-4">
            <!-- AWARD 1 -->
            <div class="col-md-4">
                <div class="award-card card border-0 shadow-sm rounded-4 h-100 text-center p-4 animate-on-scroll">
                    <div class="award-icon mb-3">
                        <i class="fas fa-medal text-warning"></i>
                        <div class="sparkle sparkle-1">✨</div>
                        <div class="sparkle sparkle-2">✨</div>
                        <div class="sparkle sparkle-3">✨</div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Eco Innovation Award 2024</h5>
                    <p class="text-muted">
                        Penghargaan inovasi teknologi ramah lingkungan
                    </p>
                </div>
            </div>
            
            <!-- AWARD 2 -->
            <div class="col-md-4">
                <div class="award-card card border-0 shadow-sm rounded-4 h-100 text-center p-4 animate-on-scroll">
                    <div class="award-icon mb-3">
                        <i class="fas fa-award text-success"></i>
                        <div class="sparkle sparkle-1">✨</div>
                        <div class="sparkle sparkle-2">✨</div>
                        <div class="sparkle sparkle-3">✨</div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Green Champion Award</h5>
                    <p class="text-muted">
                        Juara kampanye lingkungan terbaik
                    </p>
                </div>
            </div>
            
            <!-- AWARD 3 -->
            <div class="col-md-4">
                <div class="award-card card border-0 shadow-sm rounded-4 h-100 text-center p-4 animate-on-scroll">
                    <div class="award-icon mb-3">
                        <i class="fas fa-leaf text-primary"></i>
                        <div class="sparkle sparkle-1">✨</div>
                        <div class="sparkle sparkle-2">✨</div>
                        <div class="sparkle sparkle-3">✨</div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Sustainability Excellence</h5>
                    <p class="text-muted">
                        Penghargaan keunggulan keberlanjutan
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION SELAMAT DATANG YANG DIPERBAIKI -->
<section id="welcome-section" class="section-fade py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-primary mx-auto mb-3">
                <i class="fas fa-heart"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Selamat Datang di UKS SMKN 8 Jakarta</h2>
            <p class="text-muted fs-5" style="max-width: 700px; margin: auto;">
                Kami hadir untuk memberikan layanan kesehatan dasar, edukasi hidup sehat, dan pertolongan pertama bagi seluruh siswa.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- KARTU BERITA -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-card animate-on-scroll">
                    <div class="card-icon-wrapper mb-3">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Berita Kesehatan</h5>
                    <p class="text-muted small mb-4">
                        Dapatkan informasi terbaru dan tips hidup sehat dari UKS sekolah kita.
                    </p>
                    <a href="{{ route('berita.index') }}" 
                       class="btn btn-hero px-4 py-2 fw-semibold shadow-sm">
                       <i class="fas fa-newspaper me-2"></i>Baca Berita
                    </a>
                </div>
            </div>
            
            <!-- KARTU LAYANAN -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-card animate-on-scroll">
                    <div class="card-icon-wrapper mb-3">
                        <i class="fas fa-first-aid"></i>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Layanan UKS</h5>
                    <p class="text-muted small mb-4">
                        Akses layanan kesehatan dasar dan pertolongan pertama di UKS sekolah.
                    </p>
                    <a href="#" 
                       class="btn btn-hero-outline px-4 py-2 fw-semibold shadow-sm">
                       <i class="fas fa-arrow-right me-2"></i>Lihat Layanan
                    </a>
                </div>
            </div>
            
            <!-- KARTU EDUKASI -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-card animate-on-scroll">
                    <div class="card-icon-wrapper mb-3">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Edukasi Kesehatan</h5>
                    <p class="text-muted small mb-4">
                        Pelajari tips dan informasi kesehatan untuk hidup lebih sehat setiap hari.
                    </p>
                    <a href="#" 
                       class="btn btn-hero px-4 py-2 fw-semibold shadow-sm">
                       <i class="fas fa-graduation-cap me-2"></i>Pelajari
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION VISI & MISI YANG DIPERBAIKI -->
<section id="vision-mission" class="section-fade py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-warning mx-auto mb-3">
                <i class="fas fa-bullseye"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Visi & Misi UKS SMKN 8 Jakarta</h2>
            <p class="text-muted" style="max-width: 700px; margin: auto;">
                Pedoman dan arah yang menjadi landasan dalam memberikan pelayanan kesehatan terbaik bagi seluruh warga sekolah.
            </p>
        </div>

        <div class="row g-5">
            <!-- VISI -->
            <div class="col-lg-6">
                <div class="vision-card card border-0 shadow-lg rounded-4 h-100 animate-on-scroll">
                    <div class="card-body p-5 position-relative">
                        <div class="vision-decoration">
                            <div class="decoration-circle circle-1"></div>
                            <div class="decoration-circle circle-2"></div>
                            <div class="decoration-circle circle-3"></div>
                        </div>
                        
                        <div class="text-center mb-4">
                            <div class="vision-icon-wrapper mb-3">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h3 class="fw-bold text-danger mb-3">Visi Kami</h3>
                        </div>
                        
                        <div class="vision-content text-center">
                            <p class="vision-text fs-5 fw-medium text-dark mb-4">
                                "Menjadi UKS unggul dalam memberikan layanan kesehatan, meningkatkan kesadaran hidup sehat, dan menciptakan lingkungan sekolah yang aman dan nyaman."
                            </p>
                            
                            <div class="vision-highlights">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="p-3">
                                            <div class="highlight-icon text-primary mb-2">
                                                <i class="fas fa-heartbeat"></i>
                                            </div>
                                            <h6 class="fw-semibold">Layanan Unggul</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-3">
                                            <div class="highlight-icon text-success mb-2">
                                                <i class="fas fa-brain"></i>
                                            </div>
                                            <h6 class="fw-semibold">Kesadaran Sehat</h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-3">
                                            <div class="highlight-icon text-info mb-2">
                                                <i class="fas fa-shield-alt"></i>
                                            </div>
                                            <h6 class="fw-semibold">Lingkungan Aman</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- MISI -->
            <div class="col-lg-6">
                <div class="mission-card card border-0 shadow-lg rounded-4 h-100 animate-on-scroll">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="mission-icon-wrapper mb-3">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3 class="fw-bold text-success mb-3">Misi Kami</h3>
                        </div>
                        
                        <div class="mission-content">
                            <div class="mission-item d-flex align-items-start mb-4">
                                <div class="mission-step me-3">
                                    <div class="step-number">1</div>
                                </div>
                                <div class="mission-text flex-grow-1">
                                    <h5 class="fw-semibold text-dark mb-2">Pertolongan Pertama</h5>
                                    <p class="text-muted mb-0">Memberikan pertolongan pertama yang cepat dan tepat kepada siswa yang membutuhkan.</p>
                                </div>
                            </div>
                            
                            <div class="mission-item d-flex align-items-start mb-4">
                                <div class="mission-step me-3">
                                    <div class="step-number">2</div>
                                </div>
                                <div class="mission-text flex-grow-1">
                                    <h5 class="fw-semibold text-dark mb-2">Edukasi Kesehatan</h5>
                                    <p class="text-muted mb-0">Mengedukasi tentang pola hidup bersih dan sehat melalui program yang menarik.</p>
                                </div>
                            </div>
                            
                            <div class="mission-item d-flex align-items-start mb-4">
                                <div class="mission-step me-3">
                                    <div class="step-number">3</div>
                                </div>
                                <div class="mission-text flex-grow-1">
                                    <h5 class="fw-semibold text-dark mb-2">Kerjasama Strategis</h5>
                                    <p class="text-muted mb-0">Membangun kerjasama yang baik dengan puskesmas dan instansi terkait lainnya.</p>
                                </div>
                            </div>
                            
                            <div class="mission-item d-flex align-items-start">
                                <div class="mission-step me-3">
                                    <div class="step-number">4</div>
                                </div>
                                <div class="mission-text flex-grow-1">
                                    <h5 class="fw-semibold text-dark mb-2">Lingkungan Sehat</h5>
                                    <p class="text-muted mb-0">Menjaga kebersihan dan kesehatan lingkungan sekolah secara berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- NILAI-NILAI UTAMA -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="values-section bg-light rounded-4 p-5 text-center animate-on-scroll">
                    <h3 class="fw-bold text-dark mb-4">
                        <i class="fas fa-star me-2 text-warning"></i>
                        Nilai-Nilai Kami
                    </h3>
                    
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="value-item p-3">
                                <div class="value-icon text-primary mb-3">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <h5 class="fw-semibold text-dark">Peduli</h5>
                                <p class="text-muted small">Memberikan pelayanan dengan kasih sayang dan perhatian</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="value-item p-3">
                                <div class="value-icon text-success mb-3">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h5 class="fw-semibold text-dark">Profesional</h5>
                                <p class="text-muted small">Bekerja dengan standar tinggi dan keahlian</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="value-item p-3">
                                <div class="value-icon text-info mb-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="fw-semibold text-dark">Kolaboratif</h5>
                                <p class="text-muted small">Bekerja sama untuk hasil yang lebih baik</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="value-item p-3">
                                <div class="value-icon text-warning mb-3">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h5 class="fw-semibold text-dark">Inovatif</h5>
                                <p class="text-muted small">Terus berinovasi dalam pelayanan kesehatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- CSS TAMBAHAN -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

body {
    font-family: 'Poppins', sans-serif;
    color: #333;
    background: #fff;
}

.hero-section {
    background: url('{{ asset('images/bg.jpg') }}') center/cover no-repeat;
    background-attachment: fixed;
    position: relative;
    overflow: hidden;
    height: calc(100vh - 90px);
}

.hero-overlay {
    background-color: rgba(255,255,255,0.88);
    position: absolute;
    inset: 0;
    z-index: 1;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    line-height: 1.2;
    font-weight: 700;
    color: #2B3A55;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease;
}

.hero-subtitle {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease 0.2s;
    color: #555;
}

.highlight-text {
    background-color: #00B894;
    color: #fff;
    padding: 0 18px;
    border-radius: 10px;
    display: inline-block;
    transform: rotate(-1deg);
}

.hero-buttons a {
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-hero {
    background-color: #00B894;
    color: #fff;
    border: none;
}

.btn-hero:hover {
    background-color: #009C8C;
    color: #fff;
}

.btn-hero-outline {
    border: 2px solid #00B894;
    color: #009C8C;
    background: transparent;
}

.btn-hero-outline:hover {
    background-color: #00B894;
    color: #fff;
}

.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Icon Styles */
.icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.icon-small {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
}

.facility-icon, .issue-icon, .education-icon {
    font-size: 2.5rem;
    transition: all 0.3s ease;
}

.facility-item:hover .facility-icon,
.education-item:hover .education-icon {
    transform: scale(1.1) translateY(-5px);
}

/* Floating Icons in Hero */
.floating-icons {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 2;
}

.floating-icon {
    position: absolute;
    font-size: 1.8rem;
    opacity: 0.7;
    animation: float-icon 6s infinite ease-in-out;
}

.icon-1 {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.icon-2 {
    top: 60%;
    left: 15%;
    animation-delay: 1s;
}

.icon-3 {
    top: 30%;
    right: 10%;
    animation-delay: 2s;
}

.icon-4 {
    top: 70%;
    right: 15%;
    animation-delay: 3s;
}

.icon-5 {
    top: 50%;
    left: 50%;
    animation-delay: 4s;
}

@keyframes float-icon {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
        opacity: 0.7;
    }
    25% {
        transform: translate(10px, -15px) rotate(90deg);
        opacity: 1;
    }
    50% {
        transform: translate(-5px, 10px) rotate(180deg);
        opacity: 0.8;
    }
    75% {
        transform: translate(15px, 5px) rotate(270deg);
        opacity: 0.9;
    }
}

/* Scroll Down Indicator */
.scroll-down-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
}

.chevron {
    width: 20px;
    height: 5px;
    background: #00B894;
    margin: 3px 0;
    border-radius: 2px;
    animation: scroll-down 2s infinite;
}

.chevron:nth-child(2) {
    animation-delay: 0.2s;
}

.chevron:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes scroll-down {
    0%, 100% { transform: translateX(0); opacity: 0.4; }
    50% { transform: translateX(5px); opacity: 1; }
}

/* Animation Classes */
.section-fade {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease;
}

.section-visible {
    opacity: 1;
    transform: translateY(0);
}

.animate-on-scroll {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s ease;
}

.animate-visible {
    opacity: 1;
    transform: translateY(0);
}

/* ANIMASI KHUSUS UNTUK MASALAH KESEHATAN */

/* Container untuk animasi */
.virus-animation,
.injury-animation,
.mental-animation,
.award-icon {
    position: relative;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ANIMASI PENYAKIT MENULAR */
.floating-virus {
    position: absolute;
    font-size: 0.8rem;
    opacity: 0.7;
    animation: float-virus 3s infinite ease-in-out;
}

.virus-1 {
    top: 10px;
    left: 20px;
    animation-delay: 0s;
}

.virus-2 {
    top: 50px;
    right: 25px;
    animation-delay: 1s;
}

.virus-3 {
    bottom: 15px;
    left: 40px;
    animation-delay: 2s;
}

@keyframes float-virus {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
        opacity: 0.7;
    }
    25% {
        transform: translate(5px, -8px) rotate(90deg);
        opacity: 1;
    }
    50% {
        transform: translate(-3px, 5px) rotate(180deg);
        opacity: 0.8;
    }
    75% {
        transform: translate(8px, 3px) rotate(270deg);
        opacity: 0.9;
    }
}

.pulse-indicator {
    width: 8px;
    height: 8px;
    background: #dc3545;
    border-radius: 50%;
    margin: 10px auto 0;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.7;
    }
    100% {
        transform: scale(0.8);
        opacity: 1;
    }
}

/* ANIMASI CEDERA OLAHRAGA */
.running-figure {
    position: absolute;
    font-size: 1.2rem;
    animation: run 2s infinite ease-in-out;
}

.bandage {
    position: absolute;
    font-size: 0.7rem;
    opacity: 0;
    animation: bandage-fall 3s infinite;
}

.bandage-1 {
    top: 15px;
    left: 30px;
    animation-delay: 0.5s;
}

.bandage-2 {
    top: 45px;
    right: 35px;
    animation-delay: 1.5s;
}

@keyframes run {
    0%, 100% {
        transform: translateX(0) translateY(0);
    }
    25% {
        transform: translateX(5px) translateY(-3px);
    }
    50% {
        transform: translateX(10px) translateY(0);
    }
    75% {
        transform: translateX(5px) translateY(3px);
    }
}

@keyframes bandage-fall {
    0% {
        transform: translateY(-20px) rotate(0deg);
        opacity: 0;
    }
    20% {
        opacity: 1;
    }
    40% {
        transform: translateY(10px) rotate(180deg);
        opacity: 0.8;
    }
    60% {
        transform: translateY(20px) rotate(360deg);
        opacity: 0.6;
    }
    80% {
        transform: translateY(30px) rotate(540deg);
        opacity: 0.4;
    }
    100% {
        transform: translateY(40px) rotate(720deg);
        opacity: 0;
    }
}

.heartbeat-line {
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #ffc107, transparent);
    margin: 10px auto 0;
    border-radius: 2px;
    animation: heartbeat 1.5s infinite;
}

@keyframes heartbeat {
    0%, 100% {
        transform: scaleX(1);
        opacity: 0.7;
    }
    25% {
        transform: scaleX(1.3);
        opacity: 1;
    }
    50% {
        transform: scaleX(1);
        opacity: 0.7;
    }
    75% {
        transform: scaleX(1.2);
        opacity: 0.9;
    }
}

/* ANIMASI KELELAHAN MENTAL */
.thought-bubble {
    position: absolute;
    font-size: 0.6rem;
    opacity: 0;
    animation: thought-float 4s infinite;
}

.bubble-1 {
    top: 10px;
    left: 25px;
    animation-delay: 0s;
}

.bubble-2 {
    top: 35px;
    right: 20px;
    animation-delay: 1.3s;
}

.bubble-3 {
    bottom: 20px;
    left: 35px;
    animation-delay: 2.6s;
}

@keyframes thought-float {
    0% {
        transform: translateY(0) scale(0.8);
        opacity: 0;
    }
    20% {
        opacity: 0.8;
    }
    40% {
        transform: translateY(-15px) scale(1);
        opacity: 1;
    }
    60% {
        transform: translateY(-25px) scale(1.1);
        opacity: 0.7;
    }
    80% {
        transform: translateY(-35px) scale(1);
        opacity: 0.4;
    }
    100% {
        transform: translateY(-45px) scale(0.8);
        opacity: 0;
    }
}

.brain-wave {
    width: 50px;
    height: 20px;
    margin: 10px auto 0;
    position: relative;
}

.brain-wave::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 10px 10px, #17a2b8 2px, transparent 3px),
        radial-gradient(circle at 25px 5px, #17a2b8 2px, transparent 3px),
        radial-gradient(circle at 40px 15px, #17a2b8 2px, transparent 3px);
    animation: brain-pulse 2s infinite ease-in-out;
}

@keyframes brain-pulse {
    0%, 100% {
        opacity: 0.6;
        transform: scaleY(1);
    }
    50% {
        opacity: 1;
        transform: scaleY(1.3);
    }
}

/* ANIMASI PENGHARGAAN */
.sparkle {
    position: absolute;
    font-size: 0.8rem;
    opacity: 0;
    animation: sparkle-pop 3s infinite;
}

.sparkle-1 {
    top: 5px;
    left: 15px;
    animation-delay: 0s;
}

.sparkle-2 {
    top: 15px;
    right: 10px;
    animation-delay: 1s;
}

.sparkle-3 {
    bottom: 10px;
    left: 20px;
    animation-delay: 2s;
}

@keyframes sparkle-pop {
    0%, 100% {
        transform: scale(0) rotate(0deg);
        opacity: 0;
    }
    50% {
        transform: scale(1.2) rotate(180deg);
        opacity: 1;
    }
}

.award-icon i {
    font-size: 3rem;
    animation: award-rotate 4s infinite ease-in-out;
}

@keyframes award-rotate {
    0%, 100% {
        transform: rotate(0deg) scale(1);
    }
    25% {
        transform: rotate(5deg) scale(1.05);
    }
    50% {
        transform: rotate(0deg) scale(1);
    }
    75% {
        transform: rotate(-5deg) scale(1.05);
    }
}

/* Hover effects untuk health cards */
.health-card, .award-card {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.health-card::before, .award-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.health-card:hover::before, .award-card:hover::before {
    left: 100%;
}

.health-card:hover, .award-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

/* STYLING UNTUK SECTION SELAMAT DATANG YANG DIPERBAIKI */
.card-icon-wrapper {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
    background: linear-gradient(135deg, #00B894, #009C8C);
    box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
    transition: all 0.3s ease;
}

.hover-card:hover .card-icon-wrapper {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 6px 20px rgba(0, 184, 148, 0.4);
}

/* STYLING UNTUK VISI & MISI YANG DIPERBAIKI */
.vision-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-left: 5px solid #dc3545 !important;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.vision-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(220, 53, 69, 0.1) !important;
}

.mission-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-left: 5px solid #28a745 !important;
    transition: all 0.3s ease;
}

.mission-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(40, 167, 69, 0.1) !important;
}

.vision-icon-wrapper, .mission-icon-wrapper {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
}

.vision-icon-wrapper {
    background: linear-gradient(135deg, #dc3545, #c82333);
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.mission-icon-wrapper {
    background: linear-gradient(135deg, #28a745, #218838);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.vision-text {
    line-height: 1.6;
    position: relative;
    padding: 0 20px;
}

.vision-text::before, .vision-text::after {
    content: '"';
    font-size: 3rem;
    color: #dc3545;
    opacity: 0.3;
    position: absolute;
}

.vision-text::before {
    top: -10px;
    left: 0;
}

.vision-text::after {
    bottom: -30px;
    right: 0;
}

.vision-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
}

.circle-1 {
    width: 100px;
    height: 100px;
    background: #dc3545;
    top: -30px;
    right: -30px;
}

.circle-2 {
    width: 60px;
    height: 60px;
    background: #dc3545;
    bottom: 20px;
    left: -20px;
}

.circle-3 {
    width: 40px;
    height: 40px;
    background: #dc3545;
    bottom: -10px;
    right: 40px;
}

.mission-step {
    flex-shrink: 0;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
    box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
}

.mission-item {
    transition: all 0.3s ease;
    padding: 10px;
    border-radius: 10px;
}

.mission-item:hover {
    background: rgba(40, 167, 69, 0.05);
    transform: translateX(5px);
}

.highlight-icon, .value-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.value-item {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.value-item:hover {
    transform: translateY(-5px);
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.values-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 1px solid rgba(0,0,0,0.05);
}

/* STYLING UNTUK RIWAYAT KUNJUNGAN YANG DIPERBAIKI */
.visit-row {
    transition: all 0.3s ease;
}

.visit-row:hover {
    background-color: rgba(0, 184, 148, 0.05) !important;
    transform: translateX(5px);
}

.keluhan-text {
    background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
    padding: 8px 12px;
    border-radius: 8px;
    border-left: 3px solid #2196f3;
    font-size: 0.9rem;
    line-height: 1.4;
}

.obat-text {
    background: linear-gradient(135deg, #fff3e0, #fbe9e7);
    padding: 6px 10px;
    border-radius: 6px;
    border-left: 3px solid #ff9800;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-badge {
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.status-badge:hover {
    transform: scale(1.05);
}

.stat-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.stat-card:hover {
    transform: translateY(-5px);
    border-color: #00B894;
    box-shadow: 0 8px 25px rgba(0, 184, 148, 0.15);
}

.stat-icon {
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
}

.empty-state {
    padding: 3rem 1rem;
}

.empty-icon {
    opacity: 0.7;
    transition: all 0.3s ease;
}

.empty-state:hover .empty-icon {
    opacity: 1;
    transform: scale(1.1);
}

.table th {
    border-bottom: 2px solid #00B894;
    font-weight: 600;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 184, 148, 0.02);
}

/* Staggered Animation Delays */
.animate-on-scroll:nth-child(1) { transition-delay: 0.1s; }
.animate-on-scroll:nth-child(2) { transition-delay: 0.2s; }
.animate-on-scroll:nth-child(3) { transition-delay: 0.3s; }
.animate-on-scroll:nth-child(4) { transition-delay: 0.4s; }

/* RESPONSIVE */
@media (max-width: 991px) {
    .hero-title { font-size: clamp(2rem, 6vw, 3rem); }
    .hero-subtitle { font-size: 0.95rem; }
    .icon-wrapper { width: 50px; height: 50px; font-size: 1.3rem; }
    .virus-animation, .injury-animation, .mental-animation { height: 70px; }
    .floating-icon { font-size: 1.4rem; }
    .card-icon-wrapper { width: 70px; height: 70px; font-size: 1.7rem; }
    .vision-icon-wrapper, .mission-icon-wrapper { width: 70px; height: 70px; font-size: 1.7rem; }
}

@media (max-width: 767px) {
    .hero-section { height: calc(80vh - 70px); padding: 0 15px; }
    .hero-buttons { flex-direction: column; gap: 10px; }
    .facility-icon, .issue-icon, .education-icon { font-size: 2rem; }
    .floating-virus, .bandage, .thought-bubble { font-size: 0.6rem; }
    .floating-icon { display: none; }
    .card-icon-wrapper { width: 60px; height: 60px; font-size: 1.5rem; }
    .vision-icon-wrapper, .mission-icon-wrapper { width: 60px; height: 60px; font-size: 1.5rem; }
    .vision-text { font-size: 1.1rem !important; padding: 0 10px; }
    .table th, .table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.85rem;
    }
    .keluhan-text, .obat-text {
        font-size: 0.8rem;
        padding: 6px 8px;
    }
}
</style>

<!-- JS Animasi -->
<script>
// Animasi saat scroll
document.addEventListener('DOMContentLoaded', function() {
    // Animasi hero text
    const heroTitle = document.querySelectorAll('.hero-title, .hero-subtitle');
    heroTitle.forEach(el => {
        el.style.opacity = 1;
        el.style.transform = 'translateY(0)';
    });

    // Intersection Observer untuk animasi scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('section-visible');
                
                // Animate child elements
                const childElements = entry.target.querySelectorAll('.animate-on-scroll');
                childElements.forEach((child, index) => {
                    setTimeout(() => {
                        child.classList.add('animate-visible');
                    }, index * 100);
                });
            }
        });
    }, observerOptions);

    // Observe sections
    const sections = document.querySelectorAll('.section-fade');
    sections.forEach(section => {
        observer.observe(section);
    });

    // Parallax effect
    document.addEventListener('scroll', function() {
        const hero = document.getElementById('hero');
        const scrollPosition = window.scrollY;
        hero.style.backgroundPositionY = -(scrollPosition * 0.5) + 'px';
    });
});

// Smooth scroll untuk scroll down indicator
document.querySelector('.scroll-down-indicator')?.addEventListener('click', function() {
    document.getElementById('about-uks').scrollIntoView({ 
        behavior: 'smooth' 
    });
});
</script>

@endsection