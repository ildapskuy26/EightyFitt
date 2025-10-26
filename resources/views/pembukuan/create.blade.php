@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Buat Laporan Pembukuan Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pembukuan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Laporan <span class="text-muted">(Opsional)</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   placeholder="Kosongkan untuk menggunakan judul otomatis">
                            <div class="form-text">Biarkan kosong untuk generate judul otomatis</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis_periode" class="form-label">Jenis Periode *</label>
                                <select class="form-select" id="jenis_periode" name="jenis_periode" required>
                                    <option value="">Pilih Jenis Periode</option>
                                    <option value="bulanan">Laporan Bulanan</option>
                                    <option value="tahunan">Laporan Tahunan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahun" class="form-label">Tahun *</label>
                                <select class="form-select" id="tahun" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @for($i = date('Y'); $i >= 2020; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-3" id="bulan_field" style="display: none;">
                            <label for="bulan" class="form-label">Bulan *</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">Pilih Bulan</option>
                                @foreach([
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ] as $num => $name)
                                    <option value="{{ $num }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle me-2"></i>Informasi</h6>
                            <p class="mb-0">Laporan akan mengumpulkan data dari:</p>
                            <ul class="mb-0">
                                <li>Data kunjungan pasien</li>
                                <li>Data inventaris obat</li>
                                <li>Stok obat dan distribusi</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pembukuan.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-file-text me-2"></i>Generate Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('jenis_periode').addEventListener('change', function() {
        const bulanField = document.getElementById('bulan_field');
        const bulanSelect = document.getElementById('bulan');
        
        if (this.value === 'bulanan') {
            bulanField.style.display = 'block';
            bulanSelect.required = true;
        } else {
            bulanField.style.display = 'none';
            bulanSelect.required = false;
        }
    });
</script>
@endsection