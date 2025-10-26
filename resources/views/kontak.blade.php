@extends('layouts.app')

@section('content')
<!-- HERO SECTION KONTAK -->
<section id="contact-hero" class="contact-hero-section d-flex align-items-center justify-content-center text-center position-relative">
    <div class="hero-overlay"></div>
    <div class="hero-particles" id="particles-js"></div>
    
    <div class="container position-relative z-1 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="contact-hero-content">
                    <div class="contact-icon-wrapper mb-4">
                        <div class="floating-icon">
                            <img src="/images/smk.png" alt="UKS Icon" class="img-fluid">
                        </div>
                    </div>
                    <h1 class="contact-hero-title mb-3">
                        Hubungi <span class="highlight-text">UKS Kami</span>
                    </h1>
                    <p class="contact-hero-subtitle fs-5 mb-4">
                        Kami siap mendengarkan keluhan, saran, dan pertanyaan Anda. 
                        Tim UKS SMKN 8 Jakarta akan merespons dengan cepat.
                    </p>
                    <div class="contact-features">
                        <div class="row justify-content-center g-3">
                            <div class="col-auto">
                                <span class="feature-badge">
                                    <i class="fas fa-clock me-2"></i>Respon Cepat
                                </span>
                            </div>
                            <div class="col-auto">
                                <span class="feature-badge">
                                    <i class="fas fa-shield-alt me-2"></i>Privasi Terjaga
                                </span>
                            </div>
                            <div class="col-auto">
                                <span class="feature-badge">
                                    <i class="fas fa-headset me-2"></i>Layanan Ramah
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-indicator mt-5">
                        <a href="#contact-form" class="scroll-link">
                            <div class="scroll-arrow"></div>
                            <span class="scroll-text">Kirim Pesan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION KONTAK FORM -->
<section id="contact-form" class="section-fade py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card contact-form-card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-success text-white py-4 position-relative overflow-hidden">
                        <div class="header-wave"></div>
                        <div class="row align-items-center position-relative z-1">
                            <div class="col-md-8">
                                <h3 class="fw-bold mb-0">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Kirim Pesan ke UKS
                                </h3>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="whatsapp-badge">
                                    <i class="fab fa-whatsapp me-1"></i>
                                    Via WhatsApp
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-5">
                        <form action="{{ route('kontak.send') }}" method="POST" class="row g-4" id="uks-contact-form">
                            @csrf
                            
                            <!-- Nama Field -->
                            <div class="col-md-6">
                                <div class="form-group floating-form">
                                    <input type="text" 
                                           name="nama" 
                                           id="nama"
                                           class="form-control form-control-lg"
                                           placeholder=" "
                                           required
                                           oninvalid="this.setCustomValidity('Harap isi nama lengkap')"
                                           oninput="this.setCustomValidity('')">
                                    <label for="nama" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Nama Lengkap
                                    </label>
                                    <div class="form-icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="form-feedback"></div>
                                </div>
                            </div>
                            
                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="form-group floating-form">
                                    <input type="email" 
                                           name="email" 
                                           id="email"
                                           class="form-control form-control-lg"
                                           placeholder=" ">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-2 text-success"></i>
                                        Alamat Email
                                    </label>
                                    <small class="form-text text-muted">Opsional - untuk follow up</small>
                                    <div class="form-icon">
                                        <i class="fas fa-at"></i>
                                    </div>
                                    <div class="form-feedback"></div>
                                </div>
                            </div>
                            
                            <!-- Subjek Field (Baru) -->
                            <div class="col-12">
                                <div class="form-group floating-form">
                                    <select name="subjek" id="subjek" class="form-control form-control-lg" required>
                                        <option value="" disabled selected></option>
                                        <option value="konsultasi">Konsultasi Kesehatan</option>
                                        <option value="keluhan">Keluhan Layanan</option>
                                        <option value="saran">Saran Perbaikan</option>
                                        <option value="darurat">Pil Darurat</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <label for="subjek" class="form-label fw-semibold">
                                        <i class="fas fa-tag me-2 text-info"></i>
                                        Subjek Pesan
                                    </label>
                                    <div class="form-icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="form-feedback"></div>
                                </div>
                            </div>
                            
                            <!-- Pesan Field -->
                            <div class="col-12">
                                <div class="form-group floating-form">
                                    <textarea name="pesan" 
                                              id="pesan" 
                                              class="form-control form-control-lg"
                                              rows="6"
                                              placeholder=" "
                                              required
                                              oninvalid="this.setCustomValidity('Harap isi pesan Anda')"
                                              oninput="this.setCustomValidity('')"></textarea>
                                    <label for="pesan" class="form-label fw-semibold">
                                        <i class="fas fa-comment-dots me-2 text-warning"></i>
                                        Pesan Anda
                                    </label>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1 text-info"></i>
                                        Pesan akan dikirim langsung ke WhatsApp UKS
                                    </div>
                                    <div class="form-icon textarea-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="form-feedback"></div>
                                    <div class="char-counter">
                                        <span id="char-count">0</span>/500 karakter
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg btn-send fw-semibold py-3">
                                        <i class="fab fa-whatsapp me-2"></i>
                                        Kirim Pesan via WhatsApp
                                        <span class="btn-spinner ms-2 d-none">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION INFORMASI KONTAK -->
<section id="contact-info" class="section-fade bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-info mx-auto mb-3">
                <i class="fas fa-info-circle"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Informasi Kontak Lainnya</h2>
            <p class="text-muted" style="max-width: 700px; margin: auto;">
                Beberapa cara lain untuk menghubungi UKS SMKN 8 Jakarta
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Telepon -->
            <div class="col-md-4">
                <div class="contact-method-card card border-0 shadow-sm rounded-4 text-center p-4 h-100 animate-on-scroll">
                    <div class="contact-method-icon text-primary mb-3">
                        <div class="icon-bg bg-primary-light">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Telepon</h5>
                    <p class="text-muted mb-3">
                        Hubungi kami melalui telepon untuk konsultasi cepat
                    </p>
                    <a href="tel:+62123456789" class="btn btn-outline-primary btn-sm contact-action-btn">
                        <i class="fas fa-phone me-2"></i>+62 123 4567 89
                    </a>
                </div>
            </div>
            
            <!-- Email -->
            <div class="col-md-4">
                <div class="contact-method-card card border-0 shadow-sm rounded-4 text-center p-4 h-100 animate-on-scroll">
                    <div class="contact-method-icon text-success mb-3">
                        <div class="icon-bg bg-success-light">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Email</h5>
                    <p class="text-muted mb-3">
                        Kirim email untuk pertanyaan yang membutuhkan dokumentasi
                    </p>
                    <a href="mailto:uks@smkn8jakarta.sch.id" class="btn btn-outline-success btn-sm contact-action-btn">
                        <i class="fas fa-envelope me-2"></i>uks@smkn8jakarta.sch.id
                    </a>
                </div>
            </div>
            
            <!-- Lokasi -->
            <div class="col-md-4">
                <div class="contact-method-card card border-0 shadow-sm rounded-4 text-center p-4 h-100 animate-on-scroll">
                    <div class="contact-method-icon text-warning mb-3">
                        <div class="icon-bg bg-warning-light">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </div>
                    <h5 class="fw-semibold text-dark mb-3">Lokasi</h5>
                    <p class="text-muted mb-3">
                        Kunjungi UKS kami di sekolah selama jam operasional
                    </p>
                    <a href="#" class="btn btn-outline-warning btn-sm contact-action-btn" data-bs-toggle="modal" data-bs-target="#locationModal">
                        <i class="fas fa-directions me-2"></i>Lihat Peta
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION JAM OPERASIONAL -->
<section id="operating-hours" class="section-fade py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-on-scroll">
                    <div class="card-header bg-primary text-white py-3 position-relative overflow-hidden">
                        <div class="header-wave"></div>
                        <h4 class="fw-bold mb-0 text-center position-relative z-1">
                            <i class="fas fa-clock me-2"></i>
                            Jam Operasional UKS
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row text-center">
                            <div class="col-md-6 mb-3">
                                <div class="time-slot p-3 rounded-3 bg-light h-100">
                                    <div class="time-icon mb-2">
                                        <i class="fas fa-school text-primary"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Senin - Jumat</h6>
                                    <p class="text-success fw-bold mb-1">07:00 - 15:00 WIB</p>
                                    <small class="text-muted">Hari Sekolah</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="time-slot p-3 rounded-3 bg-light h-100">
                                    <div class="time-icon mb-2">
                                        <i class="fas fa-calendar-week text-info"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Sabtu</h6>
                                    <p class="text-info fw-bold mb-1">08:00 - 12:00 WIB</p>
                                    <small class="text-muted">Kegiatan Khusus</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-warning mt-3 mb-0 text-center">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Perhatian:</strong> UKS tutup pada hari Minggu dan hari libur nasional
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION FAQ -->
<section id="faq-section" class="section-fade bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="icon-wrapper bg-warning mx-auto mb-3">
                <i class="fas fa-question-circle"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Pertanyaan Umum</h2>
            <p class="text-muted" style="max-width: 700px; margin: auto;">
                Temukan jawaban untuk pertanyaan yang sering diajukan tentang UKS
            </p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                                <i class="fas fa-stethoscope me-3 text-primary"></i>
                                Jenis layanan apa saja yang tersedia di UKS?
                            </button>
                        </h2>
                        <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                UKS menyediakan layanan pertolongan pertama, konsultasi kesehatan, pemeriksaan kesehatan rutin, penyuluhan kesehatan, dan penanganan darurat medis untuk siswa dan guru.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                <i class="fas fa-user-md me-3 text-success"></i>
                                Apakah ada tenaga medis profesional di UKS?
                            </button>
                        </h2>
                        <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, UKS didukung oleh tenaga medis profesional seperti perawat dan dokter jaga yang siap memberikan pertolongan pertama dan konsultasi kesehatan.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                <i class="fas fa-pills me-3 text-info"></i>
                                Apakah UKS menyediakan obat-obatan?
                            </button>
                        </h2>
                        <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                UKS menyediakan obat-obatan dasar untuk pertolongan pertama. Untuk obat resep, siswa perlu membawa resep dari dokter atau izin dari orang tua/wali.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL LOKASI -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold" id="locationModalLabel">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Lokasi UKS SMKN 8 Jakarta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="location-placeholder rounded-3 bg-light p-5 mb-4">
                    <i class="fas fa-map fa-4x text-muted mb-3"></i>
                    <h5 class="text-dark mb-2">Peta Lokasi UKS</h5>
                    <p class="text-muted">SMKN 8 Jakarta, Gedung UKS Lantai 1</p>
                </div>
                <div class="location-info">
                    <h6 class="fw-semibold text-dark mb-3">Alamat Lengkap:</h6>
                    <p class="text-muted mb-0">
                        Jl. SMKN 8 No. 123, Jakarta Selatan<br>
                        Gedung Utama, Lantai 1 - Ruang UKS<br>
                        <small class="text-info">(Sebelah ruang guru dan perpustakaan)</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS TAMBAHAN -->
<style>
/* Import Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

/* Pastikan font konsisten di seluruh halaman */
body, .navbar-brand, .nav-link, .btn, .form-control {
    font-family: 'Poppins', sans-serif !important;
}

/* Hero Section Kontak */
.contact-hero-section {
    background: linear-gradient(135deg, #00B894 0%, #009C8C 100%);
    position: relative;
    overflow: hidden;
    padding: 100px 0;
    color: white;
}

.contact-hero-section .hero-overlay {
    background: rgba(0, 0, 0, 0.1);
    position: absolute;
    inset: 0;
    z-index: 1;
}

.hero-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
}

.contact-icon-wrapper {
    margin: 0 auto 30px;
}

.floating-icon {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2.5rem;
    color: white;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    animation: float 3s ease-in-out infinite;
    padding: 15px;
}

.floating-icon img {
    max-width: 100%;
    height: auto;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.contact-hero-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.contact-hero-subtitle {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 400;
}

.feature-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.feature-badge:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.scroll-indicator {
    margin-top: 2rem;
}

.scroll-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.3s ease;
}

.scroll-link:hover {
    color: white;
}

.scroll-arrow {
    width: 30px;
    height: 30px;
    border-right: 2px solid rgba(255, 255, 255, 0.8);
    border-bottom: 2px solid rgba(255, 255, 255, 0.8);
    transform: rotate(45deg);
    margin-bottom: 10px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0) rotate(45deg);
    }
    40% {
        transform: translateY(-10px) rotate(45deg);
    }
    60% {
        transform: translateY(-5px) rotate(45deg);
    }
}

.scroll-text {
    font-size: 0.9rem;
    font-weight: 500;
}

/* Contact Form Styling */
.contact-form-card {
    margin-top: -50px;
    position: relative;
    z-index: 2;
}

.header-wave {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 20px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
    background-size: 1200px 20px;
}

.whatsapp-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Floating Form Styling */
.floating-form {
    position: relative;
}

.floating-form .form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px 16px 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fff;
    height: auto;
}

.floating-form .form-control:focus {
    border-color: #00B894;
    box-shadow: 0 0 0 0.2rem rgba(0, 184, 148, 0.25);
    background: #fff;
    padding-top: 20px;
    padding-bottom: 8px;
}

.floating-form .form-control:focus + label,
.floating-form .form-control:not(:placeholder-shown) + label {
    top: 4px;
    left: 16px;
    font-size: 0.75rem;
    color: #00B894;
}

.floating-form label {
    position: absolute;
    top: 16px;
    left: 16px;
    font-size: 1rem;
    color: #6c757d;
    transition: all 0.3s ease;
    pointer-events: none;
    margin-bottom: 0;
    z-index: 1;
}

.floating-form select.form-control {
    padding-top: 20px;
    padding-bottom: 8px;
}

.floating-form textarea.form-control {
    padding-top: 28px;
}

.floating-form textarea.form-control + label {
    top: 20px;
}

.floating-form textarea.form-control:focus + label,
.floating-form textarea.form-control:not(:placeholder-shown) + label {
    top: 8px;
}

.form-control-lg {
    padding: 16px 20px;
    font-size: 1.1rem;
}

.form-label {
    font-size: 1rem;
    color: #2B3A55;
}

.form-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1.1rem;
    z-index: 2;
}

.textarea-icon {
    top: 30px;
    transform: none;
}

.form-feedback {
    font-size: 0.85rem;
    margin-top: 5px;
    min-height: 20px;
}

.char-counter {
    text-align: right;
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 5px;
}

.form-text {
    font-size: 0.85rem;
    margin-top: 8px;
}

/* Button Styling */
.btn-send {
    background: linear-gradient(135deg, #25D366, #128C7E);
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-send:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
}

.btn-send:active {
    transform: translateY(0);
}

.btn-spinner {
    font-size: 1rem;
}

/* Contact Method Cards */
.contact-method-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.contact-method-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #00B894, #009C8C);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}

.contact-method-card:hover::before {
    transform: scaleX(1);
}

.contact-method-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.contact-method-icon {
    margin-bottom: 1rem;
}

.icon-bg {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
}

.bg-primary-light {
    background-color: rgba(13, 110, 253, 0.1);
}

.bg-success-light {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-warning-light {
    background-color: rgba(255, 193, 7, 0.1);
}

.contact-action-btn {
    transition: all 0.3s ease;
}

.contact-action-btn:hover {
    transform: translateY(-2px);
}

/* Time Slot Styling */
.time-slot {
    transition: all 0.3s ease;
    border: 2px solid transparent;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.time-slot:hover {
    border-color: #00B894;
    transform: scale(1.05);
}

.time-icon {
    font-size: 2rem;
}

/* FAQ Styling */
.accordion-button {
    background-color: white;
    font-size: 1rem;
    padding: 1.25rem 1.5rem;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #00B894;
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0, 184, 148, 0.25);
}

.accordion-body {
    padding: 1.5rem;
    background-color: #f8f9fa;
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

/* Highlight Text */
.highlight-text {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0 12px;
    border-radius: 8px;
    display: inline-block;
}

/* Location Placeholder */
.location-placeholder {
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
}

.location-placeholder:hover {
    border-color: #00B894;
    background: rgba(0, 184, 148, 0.05);
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-hero-section {
        padding: 80px 0;
    }
    
    .contact-form-card {
        margin-top: -30px;
    }
    
    .floating-icon {
        width: 100px;
        height: 100px;
        font-size: 2rem;
    }
    
    .feature-badge {
        font-size: 0.8rem;
        padding: 6px 12px;
    }
    
    .form-control-lg {
        padding: 14px 16px;
        font-size: 1rem;
    }
    
    .card-body {
        padding: 2rem !important;
    }
}

@media (max-width: 576px) {
    .contact-hero-title {
        font-size: 1.8rem;
    }
    
    .contact-hero-subtitle {
        font-size: 1rem !important;
    }
    
    .icon-bg {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>

<!-- JavaScript untuk Animasi dan Interaksi -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi Particles.js
    if (document.getElementById('particles-js')) {
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#ffffff"
                },
                shape: {
                    type: "circle",
                    stroke: {
                        width: 0,
                        color: "#000000"
                    }
                },
                opacity: {
                    value: 0.5,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 2,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "grab"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 140,
                        line_linked: {
                            opacity: 1
                        }
                    },
                    push: {
                        particles_nb: 4
                    }
                }
            },
            retina_detect: true
        });
    }

    // Animasi scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('section-visible');
                
                const childElements = entry.target.querySelectorAll('.animate-on-scroll');
                childElements.forEach((child, index) => {
                    setTimeout(() => {
                        child.classList.add('animate-visible');
                    }, index * 100);
                });
            }
        });
    }, observerOptions);

    const sections = document.querySelectorAll('.section-fade');
    sections.forEach(section => {
        observer.observe(section);
    });

    // Form submission animation
    const contactForm = document.getElementById('uks-contact-form');
    const submitBtn = document.querySelector('.btn-send');
    const spinner = document.querySelector('.btn-spinner');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Tampilkan spinner
            if (submitBtn && spinner) {
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
            }
            
            // Simulasi pengiriman (bisa dihapus di production)
            setTimeout(() => {
                if (submitBtn && spinner) {
                    submitBtn.disabled = false;
                    spinner.classList.add('d-none');
                }
            }, 2000);
        });
    }

    // Real-time validation
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
        });
        
        input.addEventListener('blur', function() {
            validateField(this);
        });
    });

    // Validasi field
    function validateField(field) {
        const feedback = field.parentNode.querySelector('.form-feedback');
        
        if (field.hasAttribute('required') && field.value.trim() === '') {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            if (feedback) {
                feedback.innerHTML = '<i class="fas fa-exclamation-circle me-1 text-danger"></i>Field ini wajib diisi';
                feedback.classList.add('text-danger');
                feedback.classList.remove('text-success');
            }
        } else {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            if (feedback) {
                feedback.innerHTML = '<i class="fas fa-check-circle me-1 text-success"></i>Field valid';
                feedback.classList.add('text-success');
                feedback.classList.remove('text-danger');
            }
        }
        
        // Validasi email khusus
        if (field.type === 'email' && field.value.trim() !== '') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(field.value)) {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
                if (feedback) {
                    feedback.innerHTML = '<i class="fas fa-exclamation-circle me-1 text-danger"></i>Format email tidak valid';
                    feedback.classList.add('text-danger');
                    feedback.classList.remove('text-success');
                }
            }
        }
    }

    // Counter karakter untuk textarea
    const textarea = document.getElementById('pesan');
    const charCount = document.getElementById('char-count');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 450) {
                charCount.classList.add('text-warning');
            } else {
                charCount.classList.remove('text-warning');
            }
            
            if (count > 500) {
                charCount.classList.add('text-danger');
                this.value = this.value.substring(0, 500);
                charCount.textContent = 500;
            } else {
                charCount.classList.remove('text-danger');
            }
        });
    }

    // Smooth scroll untuk navigasi
    const scrollLinks = document.querySelectorAll('.scroll-link');
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Fungsi untuk scroll ke section
function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({
        behavior: 'smooth'
    });
}
</script>
@endsection