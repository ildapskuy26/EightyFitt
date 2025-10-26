@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #25D366;
        --secondary: #128C7E;
        --dark: #075E54;
        --light: #f8f9fa;
        --accent: #34B7F1;
        --gray: #6c757d;
        --light-gray: #e9ecef;
    }
    
    /* Reset & Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f8fafc;
        overflow-x: hidden;
    }
    
    /* Hero Section - White Background */
    .hero-section {
        background: white;
        color: #333;
        padding: 120px 0 100px;
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        width: 100%;
    }
    
    .logo-container {
        margin-bottom: 2rem;
        animation: fadeInDown 1s ease-out;
    }
    
    .school-logo {
        max-width: 120px;
        height: auto;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        transition: transform 0.3s ease;
    }
    
    .school-logo:hover {
        transform: scale(1.05);
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }
    
    .hero-subtitle {
        font-size: 1.4rem;
        color: var(--gray);
        margin-bottom: 3rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }
    
    /* Enhanced Star Animation - Now Visible */
    .stars-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }
    
    .star {
        position: absolute;
        background: var(--primary);
        border-radius: 50%;
        animation: twinkle 3s infinite ease-in-out;
        opacity: 0.8;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px var(--primary);
    }
    
    .star:hover {
        transform: scale(1.5);
        background: var(--accent);
        box-shadow: 0 0 20px var(--accent);
    }
    
    .star.dragging {
        animation: none;
        z-index: 1000;
    }
    
    /* Cards */
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }
    
    .card-primary {
        border-top: 4px solid var(--primary);
    }
    
    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-primary-custom:hover::before {
        left: 100%;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3);
        color: white;
    }
    
    .btn-outline-custom {
        border: 2px solid var(--primary);
        color: var(--primary);
        background: transparent;
        padding: 10px 28px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-outline-custom:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Section Styles */
    .section {
        padding: 80px 0;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark);
        text-align: center;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        color: var(--gray);
        text-align: center;
        max-width: 600px;
        margin: 0 auto 3rem;
    }
    
    /* Programs Section - New Section */
    .programs-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .program-card {
        text-align: center;
        padding: 2.5rem 1.5rem;
        height: 100%;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }
    
    .program-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(37, 211, 102, 0.1), transparent);
        transition: left 0.8s ease;
    }
    
    .program-card:hover::before {
        left: 100%;
    }
    
    .program-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
        transition: all 0.5s ease;
        position: relative;
        z-index: 2;
    }
    
    .program-card:hover .program-icon {
        transform: scale(1.2) rotate(10deg);
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
    }
    
    .program-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--dark);
        position: relative;
        z-index: 2;
    }
    
    .program-description {
        color: var(--gray);
        line-height: 1.6;
        position: relative;
        z-index: 2;
    }
    
    /* Operating Hours Section - White Background */
    .hours-section {
        background: white;
        padding: 100px 0;
    }
    
    .hours-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        text-align: center;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        border: 2px solid var(--light-gray);
    }
    
    .hours-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
    }
    
    .hours-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    
    .hours-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        display: block;
        color: var(--primary);
    }
    
    .hours-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: var(--dark);
    }
    
    .hours-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .hours-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid var(--light-gray);
        transition: all 0.3s ease;
    }
    
    .hours-item:hover {
        background: rgba(37, 211, 102, 0.05);
        transform: translateX(10px);
    }
    
    .hours-item:last-child {
        border-bottom: none;
    }
    
    .day {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--dark);
    }
    
    .time {
        font-weight: 500;
        background: var(--light-gray);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        color: var(--dark);
    }
    
    /* Gallery */
    .gallery-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    
    .gallery-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .gallery-main {
        height: 400px;
        position: relative;
        overflow: hidden;
    }
    
    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .gallery-main:hover .gallery-image {
        transform: scale(1.05);
    }
    
    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 2rem;
    }
    
    .gallery-thumbnails {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--light-gray);
    }
    
    .gallery-thumb {
        height: 100px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .gallery-thumb:hover img {
        transform: scale(1.1);
    }
    
    .gallery-thumb.active {
        border: 3px solid var(--primary);
    }
    
    .gallery-thumb.active::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(37, 211, 102, 0.2);
    }
    
    /* Contact Form */
    .contact-form {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control {
        border: 2px solid var(--light-gray);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 211, 102, 0.1);
        outline: none;
    }
    
    /* Enhanced Submit Button Animation */
    .submit-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .submit-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }
    
    .submit-btn:hover::after {
        width: 300px;
        height: 300px;
    }
    
    .submit-btn:active {
        transform: scale(0.95);
    }
    
    .submit-btn.sending {
        background: var(--secondary);
        transform: scale(0.95);
    }
    
    .submit-btn.sending::after {
        width: 300px;
        height: 300px;
    }
    
    /* Info Cards */
    .info-card {
        padding: 2rem;
        text-align: center;
        height: 100%;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    
    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }
    
    .info-card:hover::before {
        transform: scaleX(1);
    }
    
    .info-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
        transition: all 0.4s ease;
    }
    
    .info-card:hover .info-icon {
        transform: scale(1.2) rotate(10deg);
    }
    
    .info-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }
    
    .info-content {
        color: var(--gray);
    }
    
    /* FAQ Section */
    .faq-section {
        background: white;
        padding: 80px 0;
    }
    
    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .faq-item {
        background: var(--light);
        border-radius: 15px;
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid var(--light-gray);
    }
    
    .faq-item:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .faq-question {
        padding: 1.5rem;
        font-size: 1.2rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        color: var(--dark);
    }
    
    .faq-question:hover {
        background: rgba(37, 211, 102, 0.05);
    }
    
    .faq-answer {
        padding: 0 1.5rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        opacity: 0;
        color: var(--gray);
    }
    
    .faq-item.active .faq-answer {
        padding: 0 1.5rem 1.5rem;
        max-height: 500px;
        opacity: 1;
    }
    
    .faq-icon {
        transition: transform 0.3s ease;
        color: var(--primary);
    }
    
    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }
    
    /* Floating Action */
    .floating-actions {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
    }
    
    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 5px 20px rgba(37, 211, 102, 0.4);
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        cursor: pointer;
    }
    
    .floating-btn:hover {
        transform: scale(1.1);
    }
    
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        padding: 20px;
    }
    
    .modal-overlay.active {
        display: flex;
    }
    
    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        max-width: 500px;
        width: 100%;
        max-height: 80vh;
        overflow-y: auto;
        position: relative;
    }
    
    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--gray);
        transition: color 0.3s ease;
    }
    
    .modal-close:hover {
        color: var(--dark);
    }
    
    /* Animations */
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
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes twinkle {
        0%, 100% {
            opacity: 0.3;
            transform: scale(0.8);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .animate-float {
        animation: float 3s infinite ease-in-out;
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .section {
            padding: 60px 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .contact-form {
            padding: 2rem;
        }
        
        .gallery-thumbnails {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .hours-card {
            padding: 2rem;
        }
    }
</style>

<!-- Floating Actions -->
<div class="floating-actions">
    <button class="floating-btn animate-float" onclick="scrollToTop()" title="Kembali ke Atas">
        <i class="bi bi-arrow-up"></i>
    </button>
</div>

<!-- Modal for Google Maps -->
<div class="modal-overlay" id="mapModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeMapModal()">
            <i class="bi bi-x"></i>
        </button>
        <h3 class="mb-3">Lokasi UKS di Google Maps</h3>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.59717720958!2d106.83743217501136!3d-6.315844161757001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed3a84058d97%3A0x4096d113b90b994e!2sJl.%20Pejaten%20Raya%2C%20RT.6%2FRW.6%2C%20Pejaten%20Bar.%2C%20Kec.%20Ps.%20Minggu%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012510!5e0!3m2!1sen!2sid!4v1690000000000!5m2!1sen!2sid"
                width="100%" 
                height="300" 
                style="border:0; border-radius: 10px;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="mt-3">
            <p><strong>Alamat:</strong> Jl. Pejaten Raya, RT.6/RW.6, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510</p>
            <button class="btn btn-primary-custom w-100 mt-2" onclick="openGoogleMaps()">
                <i class="bi bi-geo-alt me-2"></i>Buka di Google Maps
            </button>
        </div>
    </div>
</div>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <!-- Enhanced Stars Animation -->
    <div class="stars-container" id="starsContainer"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 hero-content">
                <div class="logo-container">
                    <img src="/images/smk.png" alt="SMK Logo" class="school-logo">
                </div>
                <h1 class="hero-title">Unit Kesehatan Sekolah</h1>
                <p class="hero-subtitle">Layanan kesehatan profesional untuk mendukung proses belajar mengajar yang optimal bagi seluruh warga sekolah.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary-custom me-3" onclick="scrollToContact()">
                        <i class="bi bi-chat-dots me-2"></i>Hubungi Kami
                    </button>
                    <button class="btn btn-outline-custom" onclick="scrollToHours()">
                        <i class="bi bi-clock me-2"></i>Jam Operasional
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section - New Section -->
<section class="section programs-section" id="programs">
    <div class="container">
        <h2 class="section-title">Program Kesehatan</h2>
        <p class="section-subtitle">Berbagai program kesehatan yang dilaksanakan untuk meningkatkan kesejahteraan warga sekolah</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card program-card card-primary animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="program-icon">
                        <i class="bi bi-clipboard2-check"></i>
                    </div>
                    <h3 class="program-title">Pemeriksaan Berkala</h3>
                    <p class="program-description">Pemeriksaan kesehatan rutin untuk siswa dan guru untuk mendeteksi masalah kesehatan sejak dini.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card program-card card-primary animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="program-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h3 class="program-title">Promosi Kesehatan</h3>
                    <p class="program-description">Kampanye dan edukasi tentang pola hidup sehat, gizi seimbang, dan pencegahan penyakit.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card program-card card-primary animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="program-icon">
                        <i class="bi bi-shield-plus"></i>
                    </div>
                    <h3 class="program-title">Imunisasi & Vaksinasi</h3>
                    <p class="program-description">Program imunisasi untuk siswa dan vaksinasi untuk meningkatkan kekebalan tubuh.</p>
                </div>
            </div>
        </div>
        
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card program-card card-primary animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="program-icon">
                        <i class="bi bi-activity"></i>
                    </div>
                    <h3 class="program-title">Skrining Kesehatan</h3>
                    <p class="program-description">Pemeriksaan khusus untuk mendeteksi gangguan penglihatan, pendengaran, dan postur tubuh.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card program-card card-primary animate-fade-in-up" style="animation-delay: 0.5s;">
                    <div class="program-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="program-title">Konseling Kesehatan</h3>
                    <p class="program-description">Layanan konseling untuk masalah kesehatan mental dan psikososial siswa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card program-card card-primary animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="program-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="program-title">Monitoring Kesehatan</h3>
                    <p class="program-description">Pemantauan berkelanjutan terhadap kondisi kesehatan seluruh warga sekolah.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Operating Hours Section - White Background -->
<section class="hours-section" id="hours">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="hours-card animate-fade-in-up">
                    <i class="bi bi-clock-history hours-icon"></i>
                    <h2 class="hours-title">Jam Operasional UKS</h2>
                    <ul class="hours-list">
                        <li class="hours-item animate-fade-in-up" style="animation-delay: 0.1s;">
                            <span class="day">Senin - Kamis</span>
                            <span class="time">07:00 - 15:00 WIB</span>
                        </li>
                        <li class="hours-item animate-fade-in-up" style="animation-delay: 0.2s;">
                            <span class="day">Jumat</span>
                            <span class="time">07:00 - 14:00 WIB</span>
                        </li>
                        <li class="hours-item animate-fade-in-up" style="animation-delay: 0.3s;">
                            <span class="day">Sabtu</span>
                            <span class="time">08:00 - 12:00 WIB</span>
                        </li>
                        <li class="hours-item animate-fade-in-up" style="animation-delay: 0.4s;">
                            <span class="day">Minggu & Hari Libur</span>
                            <span class="time">Tutup</span>
                        </li>
                    </ul>
                    <div class="mt-4">
                        <p class="mb-2"><strong>Status Saat Ini:</strong></p>
                        <span class="badge bg-success fs-6" id="current-status">Memuat...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section gallery-section">
    <div class="container">
        <h2 class="section-title">Galeri UKS</h2>
        <p class="section-subtitle">Fasilitas dan kegiatan Unit Kesehatan Sekolah</p>
        
        <div class="gallery-container">
            <div class="gallery-main">
                <img src="/images/ruanguks.jpg" 
                     alt="Ruang UKS" class="gallery-image" id="mainImage">
                <div class="gallery-caption">
                    <h4 id="mainTitle">Ruang UKS Modern</h4>
                    <p id="mainDescription">Fasilitas lengkap untuk pelayanan kesehatan yang optimal</p>
                </div>
            </div>
            <div class="gallery-thumbnails">
                <div class="gallery-thumb active" onclick="changeImage(0)">
                    <img src="/images/ruanguks.jpg" 
                         alt="Ruang UKS">
                </div>
                <div class="gallery-thumb" onclick="changeImage(1)">
                    <img src="/images/obatuks.jpg" 
                         alt="Obat-obatan">
                </div>
                <div class="gallery-thumb" onclick="changeImage(2)">
                    <img src="/images/alatkesehatan.jpg" 
                         alt="Alat Medis">
                </div>
                <div class="gallery-thumb" onclick="changeImage(3)">
                    <img src="/images/tempattidur.jpg" 
                         alt="Kamar Tidur Nyaman">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contact Section -->
<section class="section" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title">Hubungi UKS</h2>
                <p class="section-subtitle">Kirim pesan kepada kami untuk konsultasi, informasi, atau pertanyaan lainnya</p>
                
                <div class="contact-form">
                    <form action="{{ route('kontak.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Subjek Pesan</label>
                            <select name="subjek" class="form-control" required>
                                <option value="" selected disabled>Pilih subjek pesan</option>
                                <option value="konsultasi">Konsultasi Kesehatan</option>
                                <option value="pengaduan">Pengaduan Layanan</option>
                                <option value="saran">Saran & Kritik</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pesan Anda</label>
                            <textarea name="pesan" rows="6" class="form-control" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary-custom btn-lg submit-btn">
                                <i class="bi bi-send-fill me-2"></i>Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card info-card animate-fade-in-up" style="animation-delay: 0.1s;">
                    <i class="bi bi-geo-alt info-icon"></i>
                    <h3 class="info-title">Lokasi UKS</h3>
                    <div class="info-content">
                        <p>Jl. Pejaten Raya, RT.6/RW.6</p>
                        <p>Pejaten Bar., Ps. Minggu</p>
                        <p>Jakarta Selatan 12510</p>
                        <button class="btn btn-outline-custom btn-sm mt-2" onclick="showMapModal()">
                            <i class="bi bi-map me-1"></i>Lihat Peta
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card info-card animate-fade-in-up" style="animation-delay: 0.2s;">
                    <i class="bi bi-telephone info-icon"></i>
                    <h3 class="info-title">Kontak Darurat</h3>
                    <div class="info-content">
                        <p><strong>Kordinator UKS:</strong> +6281584108084</p>
                        <button class="btn btn-outline-custom btn-sm mt-2" onclick="openWhatsApp()">
                            <i class="bi bi-whatsapp me-1"></i>Hubungi via WhatsApp
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card info-card animate-fade-in-up" style="animation-delay: 0.3s;">
                    <i class="bi bi-person-check info-icon"></i>
                    <h3 class="info-title">Tenaga Medis</h3>
                    <div class="info-content">
                        <p><strong>Dokter:</strong> dr. Sari Wulandari</p>
                        <p><strong>Ketua Pokja:</strong> Bu Mila</p>
                        <p><strong>Kordinator UKS:</strong> Bu lala</p>
                        <button class="btn btn-outline-custom btn-sm mt-2" onclick="showMedicalStaffModal()">
    <i class="bi bi-people me-1"></i>Lihat Profil
</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <h2 class="section-title">Pertanyaan Umum</h2>
        <p class="section-subtitle">Informasi lengkap mengenai layanan Unit Kesehatan Sekolah</p>
        
        <div class="faq-container">
            <div class="faq-item animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apa saja layanan yang tersedia di UKS?</span>
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>UKS menyediakan berbagai layanan kesehatan termasuk pemeriksaan kesehatan rutin, pengobatan dasar, pertolongan pertama (P3K), konsultasi kesehatan, penyuluhan kesehatan, dan pemantauan kondisi kesehatan warga sekolah.</p>
                </div>
            </div>
            
            <div class="faq-item animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apakah layanan UKS gratis untuk semua siswa?</span>
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Ya, semua layanan dasar UKS seperti pemeriksaan kesehatan, pertolongan pertama, dan konsultasi kesehatan diberikan secara gratis untuk seluruh siswa, guru, dan staf sekolah.</p>
                </div>
            </div>
            
            <div class="faq-item animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bagaimana prosedur jika siswa membutuhkan pertolongan darurat?</span>
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Untuk keadaan darurat, siswa dapat langsung menghubungi guru atau staf terdekat yang akan mengantarkan ke UKS. Tim medis UKS akan memberikan pertolongan pertama dan jika diperlukan akan merujuk ke rumah sakit terdekat dengan koordinasi orang tua/wali.</p>
                </div>
            </div>
            
            <div class="faq-item animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apakah UKS menyediakan obat-obatan?</span>
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>UKS menyediakan obat-obatan dasar untuk penanganan kondisi ringan seperti sakit kepala, demam, atau luka kecil. Untuk obat-obatan khusus atau resep dokter, diperlukan koordinasi dengan orang tua/wali siswa.</p>
                </div>
            </div>
            
            <div class="faq-item animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bagaimana cara menghubungi UKS di luar jam operasional?</span>
                    <i class="bi bi-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Untuk keadaan darurat di luar jam operasional, dapat menghubungi nomor darurat sekolah atau koordinator UKS yang tersedia. Informasi kontak darurat dapat dilihat di bagian informasi kontak pada website ini.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create enhanced stars animation
        function createStars() {
            const starsContainer = document.getElementById('starsContainer');
            const starCount = 30;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                
                // Random properties with better visibility
                const size = Math.random() * 8 + 3; // Larger stars
                const left = Math.random() * 100;
                const top = Math.random() * 100;
                const delay = Math.random() * 3;
                const duration = Math.random() * 2 + 2;
                
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.left = `${left}%`;
                star.style.top = `${top}%`;
                star.style.animationDelay = `${delay}s`;
                star.style.animationDuration = `${duration}s`;
                
                // Make stars draggable
                makeStarDraggable(star);
                
                starsContainer.appendChild(star);
            }
        }
        
        // Enhanced star dragging functionality
        function makeStarDraggable(star) {
            let isDragging = false;
            let startX, startY, initialX, initialY;
            
            star.addEventListener('mousedown', startDrag);
            star.addEventListener('touchstart', startDrag);
            
            function startDrag(e) {
                isDragging = true;
                star.classList.add('dragging');
                
                const clientX = e.clientX || e.touches[0].clientX;
                const clientY = e.clientY || e.touches[0].clientY;
                
                const rect = star.getBoundingClientRect();
                startX = clientX - rect.left;
                startY = clientY - rect.top;
                
                initialX = parseFloat(star.style.left) || 0;
                initialY = parseFloat(star.style.top) || 0;
                
                document.addEventListener('mousemove', drag);
                document.addEventListener('touchmove', drag);
                document.addEventListener('mouseup', stopDrag);
                document.addEventListener('touchend', stopDrag);
                
                e.preventDefault();
            }
            
            function drag(e) {
                if (!isDragging) return;
                
                const clientX = e.clientX || e.touches[0].clientX;
                const clientY = e.clientY || e.touches[0].clientY;
                
                const newX = clientX - startX;
                const newY = clientY - startY;
                
                // Convert to percentage
                const containerWidth = document.getElementById('hero').clientWidth;
                const containerHeight = document.getElementById('hero').clientHeight;
                
                const percentX = (newX / containerWidth) * 100;
                const percentY = (newY / containerHeight) * 100;
                
                star.style.left = `${Math.max(0, Math.min(100, percentX))}%`;
                star.style.top = `${Math.max(0, Math.min(100, percentY))}%`;
                
                e.preventDefault();
            }
            
            function stopDrag() {
                isDragging = false;
                star.classList.remove('dragging');
                
                document.removeEventListener('mousemove', drag);
                document.removeEventListener('touchmove', drag);
                document.removeEventListener('mouseup', stopDrag);
                document.removeEventListener('touchend', stopDrag);
            }
        }
        
        createStars();
        
        // Update UKS Status
        function updateUKSStatus() {
            const now = new Date();
            const day = now.getDay();
            const hour = now.getHours();
            
            let isOpen = false;
            let statusText = '';
            let statusClass = '';
            
            if (day >= 1 && day <= 4) { // Monday to Thursday
                if (hour >= 7 && hour < 15) {
                    isOpen = true;
                    statusText = 'Buka Sekarang';
                    statusClass = 'bg-success';
                } else {
                    statusText = 'Sudah Tutup';
                    statusClass = 'bg-secondary';
                }
            } else if (day === 5) { // Friday
                if (hour >= 7 && hour < 14) {
                    isOpen = true;
                    statusText = 'Buka Sekarang';
                    statusClass = 'bg-success';
                } else {
                    statusText = 'Sudah Tutup';
                    statusClass = 'bg-secondary';
                }
            } else if (day === 6) { // Saturday
                if (hour >= 8 && hour < 12) {
                    isOpen = true;
                    statusText = 'Buka Sekarang';
                    statusClass = 'bg-success';
                } else {
                    statusText = 'Sudah Tutup';
                    statusClass = 'bg-secondary';
                }
            } else { // Sunday
                statusText = 'Hari Ini Tutup';
                statusClass = 'bg-secondary';
            }
            
            const statusElement = document.getElementById('current-status');
            statusElement.textContent = statusText;
            statusElement.className = `badge ${statusClass} fs-6`;
        }
        
        updateUKSStatus();
        setInterval(updateUKSStatus, 60000);
        
        // Enhanced form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('.submit-btn');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
                submitBtn.disabled = true;
                submitBtn.classList.add('sending');
                
                // Simulate API call
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Terkirim!';
                    
                    // Show success message
                    alert('Pesan berhasil dikirim! Kami akan merespons secepatnya.');
                    
                    setTimeout(() => {
                        this.reset();
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('sending');
                    }, 3000);
                }, 2000);
            });
        }
        
        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all animated elements
        document.querySelectorAll('.animate-fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(el);
        });
    });
    
    // FAQ functionality
    function toggleFAQ(element) {
        const faqItem = element.parentElement;
        faqItem.classList.toggle('active');
    }
    
    // Map Modal functionality
    function showMapModal() {
        document.getElementById('mapModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMapModal() {
        document.getElementById('mapModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    function openGoogleMaps() {
        window.open('https://maps.google.com/?q=Jl.+Pejaten+Raya,+RT.6/RW.6,+Pejaten+Bar.,+Ps.+Minggu,+Kota+Jakarta+Selatan,+Daerah+Khusus+Ibukota+Jakarta+12510', '_blank');
    }
    
    // Close modal when clicking outside
    document.getElementById('mapModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeMapModal();
        }
    });
    

    // Gallery functionality
    const galleryData = [
        {
            image: "/images/ruanguks.jpg",
            title: "Ruang UKS Modern",
            description: "Fasilitas lengkap untuk pelayanan kesehatan yang optimal"
        },
        {
            image: "/images/obatuks.jpg",
            title: "Penyediaan Obat",
            description: "Obat-obatan dasar yang selalu tersedia dan terjamin kualitasnya"
        },
        {
            image: "/images/alatkesehatan.jpg",
            title: "Alat Kesehatan",
            description: "Peralatan medis lengkap untuk pemeriksaan dan penanganan"
        },
        {
            image: "/images/tempattidur.jpg",
            title: "Kamar Tidur Nyaman",
            description: "Fasilitas istirahat yang nyaman untuk pemulihan siswa"
        }
    ];
    
    function changeImage(index) {
        const mainImage = document.getElementById('mainImage');
        const mainTitle = document.getElementById('mainTitle');
        const mainDescription = document.getElementById('mainDescription');
        const thumbs = document.querySelectorAll('.gallery-thumb');
        
        // Add fade out effect
        mainImage.style.opacity = '0';
        
        setTimeout(() => {
            // Update main image and caption
            mainImage.src = galleryData[index].image;
            mainTitle.textContent = galleryData[index].title;
            mainDescription.textContent = galleryData[index].description;
            
            // Fade in new image
            mainImage.style.opacity = '1';
            
            // Update active thumbnail
            thumbs.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }, 300);
    }
    
    // Fungsi untuk membuka WhatsApp
function openWhatsApp() {
    const phoneNumber = '6281584108084';
    const message = 'Halo, saya ingin berkonsultasi mengenai layanan UKS.';
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}

// Fungsi untuk menampilkan modal tenaga medis (Card Layout)
function showMedicalStaffModal() {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay active';
    modal.innerHTML = `
        <div class="modal-content" style="max-width: 900px; max-height: 85vh; overflow-y: auto;">
            <button class="modal-close" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
            <h3 class="mb-4 text-center" style="color: var(--dark); font-size: 2rem;">Profil Tenaga Medis UKS</h3>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <div class="card-header" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; padding: 1.5rem;">
                            <h5 class="mb-0">👩‍⚕️ Dokter</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="color: var(--dark);">dr. Sari Wulandari</h6>
                            <div class="staff-info">
                                <p class="small mb-1"><strong>Spesialis:</strong> Umum & Anak</p>
                                <p class="small mb-1"><strong>Jadwal:</strong> Senin - Kamis</p>
                                <p class="small mb-0"><strong>Waktu:</strong> 08:00 - 12:00</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <div class="card-header" style="background: linear-gradient(135deg, #FF6B6B, #FF8E53); color: white; border: none; padding: 1.5rem;">
                            <h5 class="mb-0">👩‍💼 Ketua Pokja</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="color: var(--dark);">Bu Mila</h6>
                            <div class="staff-info">
                                <p class="small mb-1"><strong>Bidang:</strong> Koordinasi Program</p>
                                <p class="small mb-1"><strong>Jadwal:</strong> Setiap Hari Kerja</p>
                                <p class="small mb-0"><strong>Tugas:</strong> Pengawasan Program</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <div class="card-header" style="background: linear-gradient(135deg, var(--accent), #4ECDC4); color: white; border: none; padding: 1.5rem;">
                            <h5 class="mb-0">👩‍⚕️ Kordinator UKS</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="color: var(--dark);">Bu Lala</h6>
                            <div class="staff-info">
                                <p class="small mb-1"><strong>Bidang:</strong> Operasional Harian</p>
                                <p class="small mb-1"><strong>Jadwal:</strong> Senin - Jumat</p>
                                <p class="small mb-0"><strong>Waktu:</strong> 07:00 - 15:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-primary-custom" onclick="this.closest('.modal-overlay').remove()">
                    <i class="bi bi-check-circle me-2"></i>Tutup
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    // Close modal ketika klik di luar konten
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.remove();
        }
    });
}

    // Utility functions
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    function scrollToContact() {
        document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });
    }
    
    function scrollToHours() {
        document.getElementById('hours').scrollIntoView({ behavior: 'smooth' });
    }
    
    
</script>
@endsection