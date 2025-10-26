@extends('layouts.app')

@section('content')
<!-- ===== Style Halaman ===== -->
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

    /* ===== Header gradasi ===== */
    .text-gradient {
        background: linear-gradient(90deg, #0d8f52, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ===== Tampilan tabel ===== */
    .table-responsive {
        border-radius: 14px;
        overflow-x: auto;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        background-color: #fff;
    }
    .table thead th {
        background: #f8faf9;
        color: #198754;
        font-weight: 600;
    }
    .table-row-hover {
        transition: all 0.25s ease-in-out;
    }
    .table-row-hover:hover {
        background-color: #ecfdf5 !important;
        transform: scale(1.005);
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }

    /* ===== Tombol animasi ===== */
    .btn {
        border-radius: 10px !important;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-primary { background: linear-gradient(135deg, #198754, #20c997); border: none; }
    .btn-primary:hover { background: linear-gradient(135deg, #157347, #17b085); }
    .btn-warning { background: linear-gradient(135deg, #f9ca24, #f39c12); border: none; }
    .btn-info { background: linear-gradient(135deg, #17a2b8, #138496); border: none; }

    /* ===== Modal ===== */
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .modal-header {
        background: linear-gradient(90deg, #198754, #20c997);
        color: white;
        border-bottom: none;
    }
    .modal-footer { border-top: none; background-color: #f8f9fa; border-radius: 0 0 15px 15px; }
</style>

<!-- ===== Notifikasi ===== -->
@if(session('warning'))
<div class="alert alert-warning fade-in shadow-sm">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('warning') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm fade-in" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container fade-in">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <h3 class="mb-0 fw-bold text-gradient d-flex align-items-center">
            <i class="bi bi-clipboard2-pulse me-2"></i> Data Kunjungan
        </h3>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('kunjungan.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah
            </a>

            <!-- Tombol buka modal ekspor -->
            <button type="button" class="btn btn-info shadow-sm text-white" data-bs-toggle="modal" data-bs-target="#csvModal">
                <i class="bi bi-file-earmark-arrow-down me-1"></i> Ekspor CSV
            </button>

            <!-- Tombol buka modal filter -->
            <button type="button" class="btn btn-warning shadow-sm text-dark" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="bi bi-funnel-fill me-1"></i> Filter
            </button>
        </div>
    </div>

    <!-- ===== Tabel Kunjungan ===== -->
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
                    <th>Tempat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kunjungan as $k)
                    @php
                        $siswa = \App\Models\Siswa::where('nis', $k->nis)->first();
                    @endphp
                    <tr class="table-row-hover"
                        @if($siswa && $siswa->riwayat_penyakit)
                            style="background-color: #ffe5e5;"
                        @endif
                    >
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nis }}</td>
                        <td class="fw-semibold">{{ $k->nama }}</td>
                        <td>{{ $k->kelas }}</td>
                        <td>{{ $k->jurusan }}</td>
                        <td>{{ $k->waktu_kedatangan }}</td>
                        <td>{{ $k->waktu_keluar ?? '-' }}</td>
                        <td>{{ $k->keluhan ?? '-' }}</td>
                        <td>
                            <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                {{ $k->obat->nama ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info-subtle text-info border border-info px-2 py-1">
                                {{ $k->tempat ?? 'UKS' }}
                            </span>
                        </td>
                        <td>
                            @php
                                $count = \App\Models\Kunjungan::where('nis', $k->nis)->count();
                                $status = $count >= 5 
                                    ? ['danger','Perlu dirujuk!'] 
                                    : ($count >= 3 
                                        ? ['warning','Sering berkunjung'] 
                                        : ['success','Normal']);
                            @endphp
                            <span class="badge bg-{{ $status[0] }}">{{ $status[1] }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kunjungan.edit',$k->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('kunjungan.destroy',$k->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data kunjungan?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted py-3">Tidak ada data kunjungan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ===== Modal Filter ===== -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="bi bi-funnel me-2"></i>Filter Data Kunjungan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="GET" action="{{ route('kunjungan.index') }}">
          <div class="modal-body">
              
              <!-- Cari NIS / Nama -->
              <div class="mb-3">
                  <label for="keyword" class="form-label fw-semibold">Cari NIS / Nama</label>
                  <input type="text" name="keyword" id="keyword" class="form-control"
                         value="{{ request('keyword') }}" placeholder="Masukkan NIS atau Nama">
              </div>

              <!-- Filter Kelas -->
              <div class="mb-3">
                  <label class="form-label fw-semibold">Cari NIS / Nama</label>
                  <input type="text" name="search" class="form-control" value="{{ request('search') }}">
              </div>

              <!-- Filter Jurusan -->
              <div class="mb-3">
                  <label class="form-label fw-semibold">Kelas</label>
                  <input type="text" name="kelas" class="form-control" value="{{ request('kelas') }}">
              </div>

              <!-- Filter Rentang Waktu -->
              <div class="row g-2 align-items-end">
                  <div class="col-md-6">
                      <label for="tanggal_mulai" class="form-label fw-semibold">Dari Tanggal</label>
                      <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                             value="{{ request('tanggal_mulai') }}">
                  </div>
                  <div class="col-md-6">
                      <label for="tanggal_selesai" class="form-label fw-semibold">Sampai Tanggal</label>
                      <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                             value="{{ request('tanggal_selesai') }}">
                  </div>
              </div>

              <!-- Tombol Cepat -->
              <div class="mt-3">
                  <label class="form-label fw-semibold">Rentang Cepat</label>
                  <div class="d-flex flex-wrap gap-2">
                      <button type="button" class="btn btn-sm btn-outline-success" onclick="setDateRange('week')">Minggu Ini</button>
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDateRange('month')">Bulan Ini</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearDateRange()">Bersihkan</button>
                  </div>
              </div>
          </div>

          <div class="modal-footer">
              <a href="{{ route('kunjungan.index') }}" class="btn btn-outline-secondary">
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

<script>
function setDateRange(type) {
    const now = new Date();
    let start, end;

    if (type === 'week') {
        const day = now.getDay(); // 0 = Minggu
        const diffToMonday = day === 0 ? 6 : day - 1;
        start = new Date(now);
        start.setDate(now.getDate() - diffToMonday);
        end = new Date(start);
        end.setDate(start.getDate() + 6);
    } else if (type === 'month') {
        start = new Date(now.getFullYear(), now.getMonth(), 1);
        end = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    }

    document.getElementById('tanggal_mulai').value = start.toISOString().split('T')[0];
    document.getElementById('tanggal_selesai').value = end.toISOString().split('T')[0];
}

function clearDateRange() {
    document.getElementById('tanggal_mulai').value = '';
    document.getElementById('tanggal_selesai').value = '';
}
</script>


<script>
    function openFilterModal() {
        const modal = new bootstrap.Modal(document.getElementById('filterModal'));
        modal.show();
    }

      <form method="GET" action="{{ route('kunjungan.export.csv') }}">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Jenis Periode</label>
            <select id="filterType" name="filter_type" class="form-select" required onchange="toggleCsvOptions()">
              <option value="all">Semua Data</option>
              <option value="week">Per Minggu (Rentang Tanggal)</option>
              <option value="month">Per Bulan</option>
              <option value="year">Per Tahun</option>
            </select>
          </div>

          <div id="weekOptions" style="display:none;">
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Mulai</label>
              <input type="date" name="start_date" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Akhir</label>
              <input type="date" name="end_date" class="form-control">
            </div>
          </div>

          <div id="monthOptions" style="display:none;">
            <div class="mb-3">
              <label class="form-label fw-semibold">Bulan</label>
              <select name="month_only" class="form-select">
                @foreach(range(1,12) as $m)
                  <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Tahun</label>
              <input type="number" name="year_only" value="{{ now()->year }}" class="form-control">
            </div>
          </div>

          <div id="yearOptions" style="display:none;">
            <div class="mb-3">
              <label class="form-label fw-semibold">Tahun</label>
              <input type="number" name="year_filter" value="{{ now()->year }}" class="form-control">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Batal
          </button>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-download"></i> Download CSV
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ===== Script ===== -->
<script>
function toggleCsvOptions() {
    const val = document.getElementById('filterType').value;
    document.getElementById('weekOptions').style.display = val === 'week' ? 'block' : 'none';
    document.getElementById('monthOptions').style.display = val === 'month' ? 'block' : 'none';
    document.getElementById('yearOptions').style.display = val === 'year' ? 'block' : 'none';
}
</script>

<!-- ===== Bootstrap JS (WAJIB) ===== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
