@extends('layouts.app')

@section('content')
<style>
    :root {
        --green-main: #2e7d32;
        --green-light: #a5d6a7;
        --green-gradient: linear-gradient(145deg, #2e7d32, #66bb6a);
        --shadow-soft: 0 4px 8px rgba(0,0,0,0.08);
    }
    .card-pembukuan {
        border: none;
        border-radius: 18px;
        box-shadow: var(--shadow-soft);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .card-pembukuan:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.1);
    }
    .text-green {
        background: var(--green-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .badge-period {
        background: var(--green-gradient);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(46,125,50,0.3);
    }
    .filter-card { border-left: 5px solid var(--green-main); }
    .btn { border-radius: 10px !important; transition: all 0.25s ease; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
    .empty-state { opacity: 0.8; transition: 0.3s; }
    .empty-state:hover { opacity: 1; }
    .fade-in { opacity: 0; transform: translateY(20px); animation: fadeInUp 0.6s ease forwards; }
    @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
</style>

<div class="container-fluid py-4 fade-in">
    {{-- 🔹 Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-green d-flex align-items-center gap-2">
            <i class="bi bi-journal-medical"></i> Pembukuan UKS
        </h2>
        <a href="{{ route('pembukuan.create') }}" class="btn btn-success d-flex align-items-center gap-2 px-3">
            <i class="bi bi-plus-circle"></i> Buat Laporan Baru
        </a>
    </div>

    {{-- 🔍 Filter Section --}}
    <div class="card card-pembukuan filter-card mb-4">
        <div class="card-body">
            <form action="{{ route('pembukuan.index') }}" method="GET" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jenis Periode</label>
                        <select name="jenis_periode" id="jenis_periode" class="form-select shadow-sm">
                            <option value="">Semua</option>
                            <option value="bulanan" {{ request('jenis_periode') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ request('jenis_periode') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="bulan_field" style="display:none;">
                        <label class="form-label fw-semibold">Bulan</label>
                        <select name="bulan" class="form-select shadow-sm">
                            <option value="">Semua Bulan</option>
                            @foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $num => $name)
                                <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" id="tahun_field" style="display:none;">
                        <label class="form-label fw-semibold">Tahun</label>
                        <select name="tahun" class="form-select shadow-sm">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Cari Judul Laporan</label>
                        <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari laporan..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- 📊 Daftar Pembukuan --}}
    <div class="row">
        @forelse($pembukuans as $pembukuan)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card card-pembukuan h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-green mb-0">{{ $pembukuan->judul }}</h5>
                        <span class="badge-period">{{ ucfirst($pembukuan->jenis_periode) }}</span>
                    </div>
                    <p class="text-muted mb-3">
                        <i class="bi bi-calendar me-1"></i>
                        {{ $pembukuan->periode->translatedFormat('F Y') }}
                    </p>
                    <div class="row text-center mb-3">
                        <div class="col-6 border-end">
                            <h4 class="fw-bold text-success">{{ $pembukuan->total_kunjungan }}</h4>
                            <small class="text-muted">Kunjungan</small>
                        </div>
                        <div class="col-6">
                            <h4 class="fw-bold text-success">{{ $pembukuan->total_obat }}</h4>
                            <small class="text-muted">Total Obat</small>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <h6 class="fw-bold {{ $pembukuan->obat_hampir_habis > 0 ? 'text-warning' : 'text-success' }}">
                                {{ $pembukuan->obat_hampir_habis }}
                            </h6>
                            <small class="text-muted">Obat Hampir Habis</small>
                        </div>
                        <div class="col-6">
                            <h6 class="fw-bold text-success">{{ $pembukuan->obat_terdistribusi }}</h6>
                            <small class="text-muted">Obat Terdistribusi</small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 pt-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            {{-- Detail --}}
                            <a href="{{ route('pembukuan.show', $pembukuan->id) }}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">
                                <i class="bi bi-eye"></i> Detail
                            </a>

                            {{-- Export langsung per laporan --}}
                            <a href="{{ route('pembukuan.export', $pembukuan->id) }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1">
                                <i class="bi bi-file-earmark-excel"></i> Export
                            </a>
                        </div>

                        {{-- Hapus --}}
                        <form action="{{ route('pembukuan.destroy', $pembukuan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" onclick="return confirm('Hapus laporan ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card card-pembukuan empty-state text-center py-5">
                <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                <h5 class="text-muted mt-3">Belum ada laporan pembukuan</h5>
                <p class="text-muted">Buat laporan pertama Anda untuk mulai mencatat aktivitas UKS</p>
                <a href="{{ route('pembukuan.create') }}" class="btn btn-success d-inline-flex gap-2 mt-2">
                    <i class="bi bi-plus-circle"></i> Buat Laporan Pertama
                </a>
            </div>
        </div>
        @endforelse
    </div>

    @if($pembukuans->hasPages())
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $pembukuans->links() }}
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const jenisPeriode = document.getElementById("jenis_periode");
    const bulanField = document.getElementById("bulan_field");
    const tahunField = document.getElementById("tahun_field");
    function toggleFields() {
        const value = jenisPeriode.value;
        bulanField.style.display = value === "bulanan" ? "block" : "none";
        tahunField.style.display = value ? "block" : "none";
    }
    toggleFields();
    jenisPeriode.addEventListener("change", toggleFields);
});
</script>
@endsection
