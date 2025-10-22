@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient bg-success text-white rounded-top-4 d-flex align-items-center">
            <i class="bi bi-journal-medical fs-4 me-2"></i>
            <h4 class="mb-0 fw-bold">Edit Data Kunjungan</h4>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('kunjungan.update', $kunjungan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilih Siswa --}}
                <div class="mb-3">
                    <label for="nis" class="form-label fw-semibold">
                        <i class="bi bi-person-badge text-success me-1"></i> NIS Siswa
                    </label>
                    <select name="nis" id="nis" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->nis }}" {{ $kunjungan->nis == $s->nis ? 'selected' : '' }}>
                                {{ $s->nis }} - {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Waktu Kedatangan & Keluar --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-clock-history text-primary me-1"></i> Waktu Kedatangan
                        </label>
                        <input type="datetime-local" name="waktu_kedatangan" class="form-control shadow-sm"
                            value="{{ \Carbon\Carbon::parse($kunjungan->waktu_kedatangan)->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-hourglass-split text-secondary me-1"></i> Waktu Keluar
                        </label>
                        <input type="datetime-local" name="waktu_keluar" class="form-control shadow-sm"
                            value="{{ $kunjungan->waktu_keluar ? \Carbon\Carbon::parse($kunjungan->waktu_keluar)->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>

                {{-- Keluhan --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-chat-dots text-warning me-1"></i> Keluhan
                    </label>
                    <textarea name="keluhan" class="form-control shadow-sm" rows="3">{{ $kunjungan->keluhan }}</textarea>
                </div>

                {{-- Diagnosis --}}
                <div class="mb-3">
                    <label for="diagnosis" class="form-label fw-semibold">
                        <i class="bi bi-heart-pulse text-danger me-1"></i> Diagnosis
                    </label>
                    <input type="text" name="diagnosis" class="form-control shadow-sm"
                        value="{{ $kunjungan->diagnosis }}" required>
                </div>

                {{-- Obat --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-capsule-pill text-info me-1"></i> Obat yang Diberikan
                    </label>
                    <select name="obat_id" class="form-select shadow-sm">
                        <option value="">-- Tidak Ada --</option>
                        @foreach($obat as $o)
                            <option value="{{ $o->id }}" {{ $kunjungan->obat_id == $o->id ? 'selected' : '' }}>
                                {{ $o->nama }} ({{ $o->kategori_dosis }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('kunjungan.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success px-4 rounded-3">
                        <i class="bi bi-save2 me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Import Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#nis').select2({
            placeholder: "-- Pilih Siswa --",
            allowClear: true,
            width: '100%'
        });
    });
</script>

{{-- Styling tambahan --}}
<style>
    .select2-container .select2-selection--single {
        height: 40px !important;
        border: 1px solid #ced4da !important;
        border-radius: 8px !important;
        padding: 6px 8px !important;
    }

    .form-label i {
        font-size: 1rem;
    }

    .form-control, .form-select {
        border-radius: 10px !important;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #198754 !important;
        box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.25) !important;
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #218838);
        border: none;
        font-weight: 600;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #23923d, #1e7a32);
        transform: scale(1.03);
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        transform: scale(1.02);
    }
</style>
@endsection
