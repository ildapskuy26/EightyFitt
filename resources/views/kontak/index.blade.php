@extends('layouts.app')

@section('content')
<style>
    .contact-card {
        border: none;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #25D366, #128C7E, #075E54);
    }
    
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
    
    .btn-kirim {
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-kirim:hover {
        background: linear-gradient(135deg, #1ebe5d, #0d7a6b);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
    }
    
    .btn-kirim::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }
    
    .btn-kirim:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }
    
    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(20, 20);
            opacity: 0;
        }
    }
    
    .fade-in {
        opacity: 0;
        transform: translateY(15px);
        animation: fadeInUp 0.8s ease forwards;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .form-control {
        border-radius: 10px;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }
    
    .form-control:focus {
        border-color: #25D366;
        box-shadow: 0 0 0 0.2rem rgba(37, 211, 102, 0.25);
    }
    
    .form-label {
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .header-icon {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }
    
    .shape {
        position: absolute;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
        width: 40px;
        height: 40px;
        background: #25D366;
        border-radius: 50%;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .shape:nth-child(2) {
        width: 30px;
        height: 30px;
        background: #128C7E;
        border-radius: 50%;
        top: 70%;
        left: 80%;
        animation-delay: 1s;
    }
    
    .shape:nth-child(3) {
        width: 50px;
        height: 50px;
        background: #075E54;
        border-radius: 50%;
        top: 40%;
        left: 85%;
        animation-delay: 2s;
    }
    
    .shape:nth-child(4) {
        width: 25px;
        height: 25px;
        background: #25D366;
        border-radius: 50%;
        top: 80%;
        left: 15%;
        animation-delay: 3s;
    }
    
    @keyframes float {
        0% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
        }
        100% {
            transform: translateY(0) rotate(360deg);
        }
    }
</style>

<div class="container py-5 fade-in">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card contact-card p-4">
                <h3 class="fw-bold text-center mb-4 text-success">
                    <i class="bi bi-chat-dots me-2 header-icon"></i>Hubungi UKS
                </h3>

                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan Anda</label>
                        <textarea name="pesan" rows="5" class="form-control" required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-kirim btn-lg">
                            <i class="bi bi-send me-2"></i>Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection