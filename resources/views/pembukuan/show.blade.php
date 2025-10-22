@extends('layouts.app')

@section('content')
<style>
    .stat-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-green">{{ $pembukuan->judul }}</h2>
                    <p class="text-muted mb-0">
                        <i class="bi bi-calendar me-1"></i>
                        Periode: {{ $pembukuan->periode->translatedFormat('F Y') }} 
                        • {{ $pembukuan->jenis_periode == 'bulanan' ? 'Laporan Bulanan' : 'Laporan Tahunan' }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('pembukuan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <form action="{{ route('pembukuan.destroy', $pembukuan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Hapus laporan ini?')">
                            <i class="bi bi-trash me-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card text-white" style="background: linear-gradient(145deg, #1B5E20, #2E7D32);">
                <div class="card-body text-center">
                    <i class="bi bi-people display-6 mb-2"></i>
                    <h3 class="fw-bold">{{ $pembukuan->total_kunjungan }}</h3>
                    <p class="mb-0">Total Kunjungan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card text-white" style="background: linear-gradient(145deg, #2E7D32, #388E3C);">
                <div class="card-body text-center">
                    <i class="bi bi-capsule display-6 mb-2"></i>
                    <h3 class="fw-bold">{{ $pembukuan->total_obat }}</h3>
                    <p class="mb-0">Total Obat</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card text-white" style="background: linear-gradient(145deg, #F57C00, #FF9800);">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle display-6 mb-2"></i>
                    <h3 class="fw-bold">{{ $pembukuan->obat_hampir_habis }}</h3>
                    <p class="mb-0">Obat Hampir Habis</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card text-white" style="background: linear-gradient(145deg, #388E3C, #4CAF50);">
                <div class="card-body text-center">
                    <i class="bi bi-box-arrow-right display-6 mb-2"></i>
                    <h3 class="fw-bold">{{ $pembukuan->obat_terdistribusi }}</h3>
                    <p class="mb-0">Obat Terdistribusi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Information -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-activity me-2"></i>Ringkasan Kunjungan</h5>
                </div>
                <div class="card-body">
                    @php
                        $ringkasanKunjungan = $pembukuan->ringkasan_kunjungan ?? [];
                    @endphp
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="fw-bold text-success">{{ $ringkasanKunjungan['total'] ?? 0 }}</h4>
                            <small class="text-muted">Total Kunjungan</small>
                        </div>
                        <div class="col-6">
                            <h4 class="fw-bold text-success">{{ $ringkasanKunjungan['rata_rata_perhari'] ?? 0 }}</h4>
                            <small class="text-muted">Rata-rata per Hari</small>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <p class="mb-1"><strong>Periode Analisis:</strong></p>
                        <p class="text-muted">{{ $ringkasanKunjungan['periode'] ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-capsule me-2"></i>Ringkasan Obat</h5>
                </div>
                <div class="card-body">
                    @php
                        $ringkasanObat = $pembukuan->ringkasan_obat ?? [];
                    @endphp
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="fw-bold text-success">{{ $ringkasanObat['total_obat'] ?? 0 }}</h4>
                            <small class="text-muted">Total Jenis Obat</small>
                        </div>
                        <div class="col-6">
                            <h4 class="fw-bold {{ ($ringkasanObat['persentase_hampir_habis'] ?? 0) > 20 ? 'text-warning' : 'text-success' }}">
                                {{ $ringkasanObat['persentase_hampir_habis'] ?? 0 }}%
                            </h4>
                            <small class="text-muted">Obat Hampir Habis</small>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <p class="mb-1"><strong>Obat Terdistribusi:</strong></p>
                        <p class="text-success fw-bold">{{ $ringkasanObat['obat_terdistribusi'] ?? 0 }} item</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Laporan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Dibuat pada:</strong> {{ $pembukuan->created_at->translatedFormat('d F Y H:i') }}</p>
                            <p><strong>Terakhir diupdate:</strong> {{ $pembukuan->updated_at->translatedFormat('d F Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Jenis Laporan:</strong> {{ $pembukuan->jenis_periode == 'bulanan' ? 'Bulanan' : 'Tahunan' }}</p>
                            <p><strong>Periode:</strong> {{ $pembukuan->periode->translatedFormat('F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection