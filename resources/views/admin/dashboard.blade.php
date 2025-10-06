@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 dashboard-animate" style="background: #f8fafc; min-height: 100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4 animate-up">
        <h2 class="fw-bold text-gradient mb-0">Dashboard Admin</h2>
        <span class="badge bg-gradient-info px-3 py-2 shadow-sm">Last Update: {{ now()->format('d M Y, H:i') }}</span>
    </div>

    <div class="row g-4">
        <!-- Kartu Statistik -->
        <div class="col-md-3 col-sm-6 animate-card">
            <div class="stat-card bg-gradient-success text-white shadow-lg rounded-4 p-4">
                <h6 class="text-uppercase mb-1 opacity-75">Total Obat</h6>
                <h3 class="fw-bold">{{ $obat->count() }}</h3>
                <i class="bi bi-capsule position-absolute bottom-0 end-0 m-3" style="font-size: 3rem; opacity: 0.15;"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 animate-card">
            <div class="stat-card bg-gradient-info text-white shadow-lg rounded-4 p-4">
                <h6 class="text-uppercase mb-1 opacity-75">Total Kunjungan</h6>
                <h3 class="fw-bold">{{ $kunjungan->sum('total') }}</h3>
                <i class="bi bi-people-fill position-absolute bottom-0 end-0 m-3" style="font-size: 3rem; opacity: 0.15;"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 animate-card">
            <div class="stat-card bg-gradient-warning text-white shadow-lg rounded-4 p-4">
                <h6 class="text-uppercase mb-1 opacity-75">Obat Hampir Habis</h6>
                <h3 class="fw-bold">{{ $obat->where('stock', '<', 10)->count() }}</h3>
                <i class="bi bi-exclamation-triangle position-absolute bottom-0 end-0 m-3" style="font-size: 3rem; opacity: 0.15;"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 animate-card">
            <div class="stat-card bg-gradient-danger text-white shadow-lg rounded-4 p-4">
                <h6 class="text-uppercase mb-1 opacity-75">Kunjungan Tahun Ini</h6>
                <h3 class="fw-bold">{{ $kunjungan->count() }}</h3>
                <i class="bi bi-bar-chart-line position-absolute bottom-0 end-0 m-3" style="font-size: 3rem; opacity: 0.15;"></i>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-lg-6 animate-up-delay">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-gradient-success text-white fw-semibold rounded-top-4 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-capsule me-2"></i> Grafik Stok Obat</span>
                    <a href="{{ route('obat.index') }}" class="btn btn-light btn-sm fw-semibold rounded-pill px-3">
                        Lihat Detail
                    </a>
                </div>
                <div class="card-body bg-white">
                    <canvas id="obatChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 animate-up-delay">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-gradient-info text-white fw-semibold rounded-top-4 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-activity me-2"></i> Grafik Kunjungan per Bulan</span>
                    <a href="{{ route('kunjungan.index') }}" class="btn btn-light btn-sm fw-semibold rounded-pill px-3">
                        Lihat Detail
                    </a>
                </div>
                <div class="card-body bg-white">
                    <canvas id="kunjunganChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<script>
    const obatData = @json($obat);
    const kunjunganData = @json($kunjungan);
    const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    // Chart: Obat
    new Chart(document.getElementById('obatChart'), {
        type: 'bar',
        data: {
            labels: obatData.map(o => o.nama),
            datasets: [{
                label: 'Jumlah Stok',
                data: obatData.map(o => o.stock),
                backgroundColor: obatData.map(() => 'rgba(25, 135, 84, 0.8)'),
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });

    // Chart: Kunjungan
    new Chart(document.getElementById('kunjunganChart'), {
        type: 'line',
        data: {
            labels: kunjunganData.map(k => bulanLabels[k.bulan - 1]),
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: kunjunganData.map(k => k.total),
                borderColor: 'rgba(13,110,253,1)',
                backgroundColor: 'rgba(13,110,253,0.15)',
                fill: true,
                tension: 0.35,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#0d6efd',
                borderWidth: 3,
            }]
        },
        options: { plugins: { legend: { display: true } }, scales: { y: { beginAtZero: true } } }
    });

    // Animasi masuk
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.animate-card, .animate-up, .animate-up-delay').forEach((el, i) => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(30px)';
            setTimeout(() => {
                el.style.transition = 'all 0.8s ease';
                el.style.opacity = 1;
                el.style.transform = 'translateY(0)';
            }, 150 * i);
        });
    });
</script>

<style>
/* Gradient Background */
.bg-gradient-success { background: linear-gradient(135deg, #1e8449, #28b463); }
.bg-gradient-info { background: linear-gradient(135deg, #0dcaf0, #0d6efd); }
.bg-gradient-warning { background: linear-gradient(135deg, #ffc107, #ffb347); }
.bg-gradient-danger { background: linear-gradient(135deg, #dc3545, #ff6b6b); }

/* Text Gradient */
.text-gradient {
    background: linear-gradient(90deg, #198754, #0d6efd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Card Hover */
.stat-card {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Entry Animation Base */
.animate-up, .animate-card, .animate-up-delay {
    opacity: 0;
    transform: translateY(20px);
}
.dashboard-animate {
    animation: fadeInBody 0.8s ease;
}
@keyframes fadeInBody {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
@endsection
