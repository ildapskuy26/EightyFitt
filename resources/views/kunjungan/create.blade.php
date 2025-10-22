@extends('layouts.app')

@section('content')
<style>
    /* ===== Animasi masuk lembut ===== */
    .fade-in {
        opacity: 0;
        transform: translateY(15px);
        animation: fadeInUp 0.6s ease forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== Header dengan gradasi ===== */
    .text-gradient {
        background: linear-gradient(90deg, #198754, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    /* ===== Kartu form ===== */
    .card-form {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        background: #fff;
        padding: 2rem;
    }

    /* ===== Label & input ===== */
    label {
        font-weight: 600;
        color: #198754;
    }

    .form-control, .form-select, .select2-selection {
        border-radius: 10px !important;
        border: 1px solid #ced4da;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus, .select2-selection:focus {
        border-color: #20c997 !important;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
    }

    /* ===== Tombol ===== */
    .btn {
        border-radius: 10px;
        transition: 0.25s all ease-in-out;
        font-weight: 500;
    }

    .btn-success {
        background: linear-gradient(90deg, #198754, #20c997);
        border: none;
    }
    .btn-success:hover {
        background: linear-gradient(90deg, #157347, #1ab085);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
    }

    /* ===== Select2 tampilan lembut ===== */
    .select2-container .select2-selection--single {
        height: 42px !important;
        display: flex;
        align-items: center;
        border-radius: 10px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px;
        right: 10px;
    }
</style>

<div class="container fade-in mt-4">
    <h3 class="mb-4 text-gradient d-flex align-items-center">
        <i class="bi bi-plus-circle me-2"></i> Tambah Kunjungan
    </h3>

    <div class="card-form fade-in">
        <form action="{{ route('kunjungan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nis" class="form-label">NIS Siswa</label>
                <select name="nis" id="nis" class="form-select" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->nis }}">{{ $s->nis }} - {{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="waktu_kedatangan" class="form-label">Waktu Kedatangan</label>
                <input type="datetime-local" name="waktu_kedatangan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                <input type="datetime-local" name="waktu_keluar" class="form-control">
            </div>

            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea name="keluhan" class="form-control" rows="3" placeholder="Tuliskan keluhan siswa..."></textarea>
            </div>

            <div class="mb-3">
                <label for="diagnosis" class="form-label">Diagnosis</label>
                <input type="text" name="diagnosis" id="diagnosis" class="form-control" placeholder="Masukkan diagnosis" required>
            </div>

            <div class="mb-4">
                <label for="obat_id" class="form-label">Obat yang Diberikan</label>
                <select name="obat_id" class="form-select">
                    <option value="">-- Tidak Ada --</option>
                    @foreach($obat as $o)
                        <option value="{{ $o->id }}">{{ $o->nama }} ({{ $o->kategori_dosis }})</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-circle me-1"></i> Simpan
                </button>
                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

{{-- ===== Select2 Library ===== --}}
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
@endsection
