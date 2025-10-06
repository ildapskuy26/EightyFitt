@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 px-4" style="background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 animate-up">
        <h2 class="fw-bold text-gradient mb-0"><i class="bi bi-person-gear me-2"></i>Dashboard Petugas</h2>
        <span class="badge bg-gradient-info px-3 py-2 shadow-sm">
            {{ now()->format('d M Y, H:i') }}
        </span>
    </div>

    <!-- Welcome Card -->
    <div class="card border-0 shadow-lg rounded-4 mb-5 animate-up" style="overflow: hidden;">
        <div class="card-body p-5 text-center bg-gradient-success text-white">
            <h4 class="fw-semibold mb-2">Selamat Datang, <span class="text-warning">{{ auth()->user()->name }}</span>!</h4>
            <p class="mb-0 opacity-75">Semoga harimu penuh semangat dan keberkahan 🌿</p>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="row g-4 justify-content-center">
        <!-- Card: Input Kunjungan -->
        <div class="col-md-5 col-sm-6 animate-card">
            <a href="{{ route('kunjungan.index') }}" class="text-decoration-none">
                <div class="menu-card bg-gradient-info text-white shadow-lg rounded-4 p-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-white text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px; height:60px;">
                            <i class="bi bi-person-plus-fill fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Input Kunjungan</h5>
                            <p class="mb-0 small opacity-75">Catat data kunjungan siswa dengan mudah</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Input Obat -->
        <div class="col-md-5 col-sm-6 animate-card">
            <a href="{{ route('obat.index') }}" class="text-decoration-none">
                <div class="menu-card bg-gradient-success text-white shadow-lg rounded-4 p-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-white text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px; height:60px;">
                            <i class="bi bi-capsule fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Input Obat</h5>
                            <p class="mb-0 small opacity-75">Tambah dan kelola stok obat UKS</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Gradient Styles */
.bg-gradient-success { background: linear-gradient(135deg, #1e8449, #28b463); }
.bg-gradient-info { background: linear-gradient(135deg, #0dcaf0, #0d6efd); }

/* Text Gradient */
.text-gradient {
    background: linear-gradient(90deg, #198754, #0d6efd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Menu Card */
.menu-card {
    transition: all 0.35s ease;
}
.menu-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.icon {
    transition: all 0.4s ease;
}
.menu-card:hover .icon {
    transform: rotate(10deg) scale(1.1);
}

/* Entry Animation */
.animate-card, .animate-up {
    opacity: 0;
    transform: translateY(20px);
}
@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.dashboard-animate {
    animation: fadeInBody 0.8s ease;
}
@keyframes fadeInBody {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Animate Elements on Load */
body.loaded .animate-card, body.loaded .animate-up {
    animation: fadeUp 0.8s forwards;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add("loaded");
});
</script>
@endsection
