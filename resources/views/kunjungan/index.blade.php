@extends('layouts.app')

@section('content')
<style>
    /* ===== Animasi masuk halaman ===== */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== Tampilan tabel & tombol ===== */
    .table-row-hover {
        transition: all 0.25s ease-in-out;
    }
    .table-row-hover:hover {
        background-color: #eaf9ef !important;
        transform: scale(1.01);
        box-shadow: 0 3px 8px rgba(0,0,0,0.06);
    }

    .btn {
        transition: 0.2s all ease-in-out;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* ===== Header gradasi ===== */
    .text-gradient {
        background: linear-gradient(90deg, #198754, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ===== Responsif tabel di HP ===== */
    @media (max-width: 768px) {
        .table thead { display: none; }
        .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
        .table tr { margin-bottom: 1rem; border: 1px solid #dee2e6; border-radius: 10px; padding: 0.75rem; background: #fff; }
        .table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }
        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            width: 45%;
            font-weight: 600;
            text-align: left;
            color: #495057;
        }
    }

    /* ===== Shadow lembut ===== */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }

    /* ===== Modal tampilan lebih elegan ===== */
    .modal-content {
        border-radius: 12px;
        border: none;
    }
    .modal-header {
        border-bottom: none;
        background: linear-gradient(90deg, #20c997, #198754);
        color: white;
    }
    .modal-footer {
        border-top: none;
    }
</style>
@if(session('warning'))
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endif


<div class="container fade-in">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <h3 class="mb-0 fw-bold text-gradient d-flex align-items-center">
            <i class="bi bi-person-lines-fill me-2"></i> Data Kunjungan
        </h3>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('kunjungan.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
            <a href="{{ route('kunjungan.export.csv') }}" class="btn btn-info shadow-sm text-white">
                <i class="bi bi-download"></i> CSV
            </a>
            <button type="button" onclick="openFilterModal()" class="btn btn-warning shadow-sm text-dark">
                <i class="bi bi-funnel-fill"></i> Filter
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm fade-in" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="table-responsive shadow-sm fade-in">
        <table class="table align-middle table-hover mb-0">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Waktu Kedatangan</th>
                    <th>Waktu Keluar</th>
                    <th>Keluhan</th>
                    <th>Obat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    @forelse($kunjungan as $k)
    <tr class="table-row-hover">
        <td data-label="No">{{ $loop->iteration }}</td>
        <td data-label="NIS">{{ $k->nis }}</td>
        <td data-label="Nama" class="fw-semibold text-dark">{{ $k->nama }}</td>
        <td data-label="Kelas">{{ $k->kelas }}</td>
        <td data-label="Jurusan">{{ $k->jurusan }}</td>
        <td data-label="Kedatangan">{{ $k->waktu_kedatangan }}</td>
        <td data-label="Keluar">{{ $k->waktu_keluar ?? '-' }}</td>
        <td data-label="Keluhan">{{ $k->keluhan ?? '-' }}</td>
        <td data-label="Obat">
            <span class="badge bg-success-subtle text-success border border-success">
                {{ $k->obat->nama ?? '-' }}
            </span>
        </td>
        <!-- Tambahkan kolom penanda kunjungan -->
        <td data-label="Kunjungan">
            @php
                $count = \App\Models\Kunjungan::where('nis', $k->nis)->count();
                if ($count >= 5) {
                    $color = 'danger';
                    $message = 'Perlu dirujuk!';
                } elseif ($count >= 3) {
                    $color = 'warning';
                    $message = 'Sering berkunjung';
                } else {
                    $color = 'success';
                    $message = 'Normal';
                }
            @endphp
            <span class="badge bg-{{ $color }}">{{ $message }}</span>
        </td>
        <td data-label="Aksi" class="text-center">
            <a href="{{ route('kunjungan.edit',$k->id) }}" class="btn btn-sm btn-outline-warning me-1">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form action="{{ route('kunjungan.destroy',$k->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Hapus data kunjungan?')">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="11" class="text-center text-muted py-3">Tidak ada data kunjungan</td>
    </tr>
    @endforelse
</tbody>

        </table>
    </div>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="bi bi-funnel me-2"></i>Filter Data Kunjungan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="GET" action="{{ route('kunjungan.index') }}">
          <div class="modal-body">
              <div class="mb-3">
                  <label for="search" class="form-label fw-semibold">Cari NIS / Nama</label>
                  <input type="text" name="search" id="search" class="form-control"
                         value="{{ request('search') }}" placeholder="Masukkan NIS atau Nama">
              </div>
              <div class="mb-3">
                  <label for="kelas" class="form-label fw-semibold">Kelas</label>
                  <input type="text" name="kelas" id="kelas" class="form-control"
                         value="{{ request('kelas') }}" placeholder="Misal: X, XI, XII">
              </div>
              <div class="mb-3">
                  <label for="jurusan" class="form-label fw-semibold">Jurusan</label>
                  <input type="text" name="jurusan" id="jurusan" class="form-control"
                         value="{{ request('jurusan') }}" placeholder="Misal: RPL, TKJ">
              </div>
              <div class="mb-3">
                  <label class="form-label fw-semibold">Rentang Waktu</label>
                  <select name="range" class="form-select">
                      <option value="" {{ request('range')=='' ? 'selected' : '' }}>Semua</option>
                      <option value="week" {{ request('range')=='week' ? 'selected' : '' }}>Perminggu</option>
                      <option value="month" {{ request('range')=='month' ? 'selected' : '' }}>Perbulan</option>
                  </select>
              </div>
          </div>
          <div class="modal-footer">
              <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">
                  <i class="bi bi-arrow-counterclockwise"></i> Reset
              </a>
              <button type="submit" class="btn btn-success">
                  <i class="bi bi-check-circle"></i> Terapkan
              </button>
          </div>
      </form>
    </div>
  </div>
</div>


@if(session('alert'))
    <div class="alert alert-{{ session('alert.type') }} shadow-sm rounded-3">
        {{ session('alert.message') }}
    </div>
@endif


<script>
    function openFilterModal() {
        const modal = new bootstrap.Modal(document.getElementById('filterModal'));
        modal.show();
    }

    // Delay animasi tiap elemen
    document.addEventListener("DOMContentLoaded", () => {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((el, i) => {
            setTimeout(() => {
                el.style.opacity = "1";
                el.style.transform = "translateY(0)";
            }, i * 100);
        });
    });
</script>
@endsection
