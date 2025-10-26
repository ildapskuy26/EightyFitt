@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5 form-card animate-fade-in" style="max-width: 600px; width: 100%;">
        <div class="text-center mb-4">
            <div class="icon-circle bg-gradient-green text-white mb-3">
                <i class="bi bi-person-plus fs-3"></i>
            </div>
            <h3 class="fw-bold text-gradient mb-1">Tambah Petugas</h3>
            <p class="text-muted mb-0">Isi data berikut untuk menambahkan petugas baru</p>
        </div>

        <form action="{{ route('petugas.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text" name="name" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Masukkan email aktif" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Minimal 6 karakter" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Ulangi password" required>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 btn-hover-animate">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm btn-hover-animate">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Animasi masuk lembut */
.animate-fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
}
@keyframes fadeInUp {
    to { opacity: 1; transform: translateY(0); }
}

/* Card styling */
.form-card {
    background: #ffffff;
    border-radius: 20px;
}

/* Lingkaran ikon */
.icon-circle {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto;
    background: linear-gradient(135deg, #0d6efd, #20c997);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* Teks gradasi */
.text-gradient {
    background: linear-gradient(90deg, #0d6efd, #20c997);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Efek hover tombol */
.btn-hover-animate {
    transition: all 0.25s ease;
}
.btn-hover-animate:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Efek fokus input */
.form-control:focus {
    border-color: #20c997;
    box-shadow: 0 0 0 0.25rem rgba(32, 201, 151, 0.25);
}

/* Gradient hijau-biru */
.bg-gradient-green {
    background: linear-gradient(135deg, #0d6efd, #20c997);
}

/* Responsif */
@media (max-width: 576px) {
    .form-card {
        padding: 2rem;
    }
}
</style>
@endsection
@section('custom_css')
{{-- 🌈 CSS Custom --}}