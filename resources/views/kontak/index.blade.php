@extends('layouts.app')

@section('content')
<style>
    .contact-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .contact-card:hover {
        transform: translateY(-5px);
    }
    .btn-whatsapp {
        background: #25D366;
        color: white;
        font-weight: 600;
    }
    .btn-whatsapp:hover {
        background: #1ebe5d;
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
</style>

<div class="container py-5 fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card contact-card p-4">
                <h3 class="fw-bold text-center mb-4 text-success">
                    <i class="bi bi-chat-dots me-2"></i>Hubungi UKS
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
                        <button type="submit" class="btn btn-whatsapp btn-lg">
                            <i class="bi bi-whatsapp me-2"></i>Kirim ke WhatsApp UKS
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
