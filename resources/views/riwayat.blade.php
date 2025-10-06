@extends('layouts.app')

@section('content')
<style>
/* ====== ANIMASI MASUK HALUS ====== */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ====== ANIMASI GLOW ====== */
@keyframes glow {
    0% { box-shadow: 0 0 0 rgba(25,135,84,0.4); }
    50% { box-shadow: 0 0 15px rgba(25,135,84,0.5); }
    100% { box-shadow: 0 0 0 rgba(25,135,84,0.4); }
}

/* ====== CARD PREMIUM STYLE ====== */
.card {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-6px);
    animation: glow 2s infinite;
}

/* ====== TABEL ====== */
.table thead {
    background: linear-gradient(135deg, #198754, #43d17d);
    color: #fff;
}
.table-hover tbody tr:hover {
    background-color: rgba(72, 199, 142, 0.08) !important;
    transform: scale(1.01);
    transition: all 0.2s ease-in-out;
}
.table-responsive {
    max-height: 480px;
    overflow-y: auto;
    border-radius: 10px;
}

/* ====== BADGE ====== */
.badge {
    font-size: 0.85rem;
    padding: 6px 10px;
    border-radius: 12px;
}

/* ====== DARK MODE ====== */
body.dark-mode {
    background-color: #0d1117 !important;
    color: #e6edf3 !important;
}
body.dark-mode .card {
    background-color: #161b22 !important;
    color: #e6edf3 !important;
    box-shadow: 0 0 10px rgba(56,139,253,0.2);
}
body.dark-mode .table thead {
    background: linear-gradient(135deg, #238636, #3fb950) !important;
}
body.dark-mode .table tbody tr:hover {
    background-color: rgba(63,185,80,0.1) !important;
}

/* ====== RESPONSIVE ====== */
@media (max-width: 768px) {
    h3 { font-size: 1.25rem; }
    .table { font-size: 0.85rem; }
    .container { padding-left: 10px; padding-right: 10px; }
}

/* ====== ANIMASI STAGGER (MASUK SATU-SATU) ====== */
.fade-item {
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.6s ease-out;
}
.fade-item.visible {
    opacity: 1;
    transform: translateY(0);
}
</style>

<div class="container py-4 fade-in">
    <h3 class="mb-4 fw-bold text-success d-flex align-items-center fade-item">
        <i class="bi bi-clock-history me-2 fs-3 text-success"></i>
        <span>Riwayat Kunjungan UKS</span>
    </h3>

    @if($riwayats->isEmpty())
        <div class="alert alert-info shadow-sm border-0 rounded-3 fade-item">
            <i class="bi bi-info-circle me-2"></i> Belum ada data kunjungan.
        </div>
    @else
        <div class="card shadow-sm border-0 rounded-4 fade-item">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-borderless table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Keluhan</th>
                                <th>Obat</th>
                                <th>Waktu Kedatangan</th>
                                <th>Waktu Keluar</th>
                            </tr>
                        </thead>
                        <tbody class="fw-medium text-secondary">
                            @foreach($riwayats as $r)
                                <tr class="fade-item">
                                    <td class="fw-semibold text-dark">{{ $r->nama }}</td>
                                    <td>{{ $r->kelas }}</td>
                                    <td>{{ $r->keluhan }}</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success">
                                            {{ $r->obat->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="bi bi-clock text-muted me-1"></i>
                                        <span class="text-muted">
                                            {{ \Carbon\Carbon::parse($r->waktu_kedatangan)->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($r->waktu_keluar)
                                            <i class="bi bi-check-circle text-success me-1"></i>
                                            <span class="text-muted">
                                                {{ \Carbon\Carbon::parse($r->waktu_keluar)->format('d M Y, H:i') }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-hourglass-split me-1"></i> Belum Keluar
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Animasi bertahap saat halaman dimuat -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.fade-item');
    items.forEach((el, i) => {
        setTimeout(() => {
            el.classList.add('visible');
        }, i * 120); // delay bertahap
    });
});
</script>
@endsection
