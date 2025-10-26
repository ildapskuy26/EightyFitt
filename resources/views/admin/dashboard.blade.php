@extends('layouts.app')

@section('content')

<div class="container-fluid py-4 px-3" style="background: #f8fafc; min-height: 100vh;">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="color: #1c4f33;">Dashboard Admin</h2>
        <small class="text-secondary">
            <i class="bi bi-clock-history me-1"></i>
            Update Terakhir: {{ now()->format('d M Y, H:i') }}
        </small>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['title' => 'Total Obat', 'value' => $obat->count(), 'icon' => 'bi-capsule', 'color' => 'linear-gradient(135deg, #184d2b, #2f6f44)', 'route' => route('obat.index')],
                ['title' => 'Total Kunjungan', 'value' => $kunjungan->sum('total'), 'icon' => 'bi-people-fill', 'color' => 'linear-gradient(135deg, #1e5b37, #3b8156)', 'route' => route('kunjungan.index')],
                ['title' => 'Obat Hampir Habis', 'value' => $obat->where("stock", "<", 10)->count(), 'icon' => 'bi-exclamation-triangle', 'color' => 'linear-gradient(135deg, #447a4a, #78b478)', 'route' => route('obat.index')],
                ['title' => 'Kunjungan Tahun Ini', 'value' => $kunjungan->count(), 'icon' => 'bi-bar-chart-line', 'color' => 'linear-gradient(135deg, #2c6c49, #4c9563)', 'route' => route('kunjungan.index')]
            ];
        @endphp

        @foreach ($cards as $index => $card)
        <div class="col-md-3 col-6">
            <div class="card stat-card border-0 text-white shadow-sm rounded-4 position-relative animate-card card-click"
                 style="background: {{ $card['color'] }}; animation-delay: {{ $index * 0.15 }}s;"
                 data-href="{{ $card['route'] }}">
                <div class="card-body">
                    <h6 class="text-uppercase small opacity-75">{{ $card['title'] }}</h6>
                    <h3 class="fw-bold mb-0">{{ $card['value'] }}</h3>
                    <i class="bi {{ $card['icon'] }} position-absolute end-0 bottom-0 pe-3 pb-2" style="font-size: 2.8rem; opacity: 0.15;"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Grafik -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 fade-up">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div class="fw-semibold text-success"><i class="bi bi-capsule me-2"></i>Grafik Stok Obat</div>
                    <a href="{{ route('obat.index') }}" class="btn btn-success btn-sm px-3 rounded-pill fw-semibold">Lihat Detail</a>
                </div>
                <div class="card-body">
                    <canvas id="obatChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 fade-up" style="animation-delay: 0.2s;">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div class="fw-semibold text-success"><i class="bi bi-activity me-2"></i>Grafik Kunjungan per Bulan</div>
                    <a href="{{ route('kunjungan.index') }}" class="btn btn-success btn-sm px-3 rounded-pill fw-semibold">Lihat Detail</a>
                </div>
                <div class="card-body">
                    <canvas id="kunjunganChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Data Siswa -->
<div class="card border-0 shadow-sm rounded-4 mb-4 fade-up" style="animation-delay: 0.3s;">
    <div class="card-body">
        <h5 class="fw-bold mb-3 text-success">
            <i class="bi bi-upload me-2"></i> Import Data Siswa (Multi File)
        </h5>

        <form action="{{ route('admin.importSiswa') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
            @csrf
            <input type="file" name="files[]" class="form-control" accept=".xlsx,.xls" multiple required>
            <button type="submit" class="btn btn-success d-flex align-items-center gap-2 w-auto">
                <i class="bi bi-arrow-up-circle"></i> Import Semua
            </button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
    </div>
</div>



<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Animasi CSS & Efek Klik -->
<style>
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-card { opacity: 0; animation: fadeUp 0.8s ease forwards; }
.fade-up { opacity: 0; animation: fadeUp 0.9s ease forwards; }

.stat-card {
    cursor: pointer;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.stat-card:active {
    transform: scale(0.97);
    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}

.animate-card:nth-child(1) { animation-delay: 0.1s; }
.animate-card:nth-child(2) { animation-delay: 0.25s; }
.animate-card:nth-child(3) { animation-delay: 0.4s; }
.animate-card:nth-child(4) { animation-delay: 0.55s; }
</style>

<!-- Klik Efek Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".card-click").forEach(card => {
        card.addEventListener("click", () => {
            card.classList.add("clicked");
            setTimeout(() => {
                window.location.href = card.dataset.href;
            }, 180);
        });
    });
});

const obatData = @json($obat);
const kunjunganData = @json($kunjungan);
const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

// Grafik Obat
new Chart(document.getElementById('obatChart'), {
    type: 'bar',
    data: {
        labels: obatData.map(o => o.nama),
        datasets: [{
            label: 'Jumlah Stok',
            data: obatData.map(o => o.stock),
            backgroundColor: '#2e8b57',
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Grafik Kunjungan
new Chart(document.getElementById('kunjunganChart'), {
    type: 'line',
    data: {
        labels: kunjunganData.map(k => bulanLabels[k.bulan - 1]),
        datasets: [{
            label: 'Jumlah Kunjungan',
            data: kunjunganData.map(k => k.total),
            borderColor: '#2e8b57',
            backgroundColor: 'rgba(46,139,87,0.15)',
            fill: true,
            tension: 0.3,
            pointRadius: 5,
            borderWidth: 3
        }]
    },
    options: {
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection
