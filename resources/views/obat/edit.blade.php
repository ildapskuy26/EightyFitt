@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-capsule me-2"></i> Edit Data Obat
            </h4>
            <a href="{{ route('obat.index') }}" class="btn btn-light btn-sm rounded-pill">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Ada masalah dengan inputan kamu.<br><br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Obat --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Obat</label>
                    <input type="text" name="nama" class="form-control rounded-pill"
                        value="{{ old('nama', $obat->nama) }}" required>
                </div>

                {{-- Jenis Obat --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Obat</label>
                    <select name="jenis_obat" class="form-select rounded-pill" required>
                        <option value="">- Pilih Jenis -</option>
                        <option value="Antibiotik" {{ old('jenis_obat', $obat->jenis_obat) == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
                        <option value="Analgesik" {{ old('jenis_obat', $obat->jenis_obat) == 'Analgesik' ? 'selected' : '' }}>Analgesik</option>
                        <option value="Antipiretik" {{ old('jenis_obat', $obat->jenis_obat) == 'Antipiretik' ? 'selected' : '' }}>Antipiretik</option>
                    </select>
                </div>

                {{-- Bentuk Obat --}}
                <div class="mb-3">
                <label class="form-label fw-semibold">Bentuk</label>
                <select name="bentuk_obat" class="form-select form-select-lg rounded-3 shadow-sm" required>
                    <option value="">- Pilih Bentuk -</option>
                    <option value="Tablet" {{ old('bentuk_obat') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="Sirup" {{ old    ('bentuk_obat') == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                    <option value="Kapsul" {{ old('bentuk_obat') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                    <option value="Tempel" {{ old('bentuk_obat') == 'Tempel' ? 'selected' : '' }}>Tempel</option>
                    <option value="Gosok" {{ old('bentuk_obat') == 'Gosok' ? 'selected' : '' }}>Gosok</option>
                    <option value="Hirup" {{ old('bentuk_obat') == 'Hirup' ? 'selected' : '' }}>Hirup</option>
                </select>
            </div>

                {{-- Dosis dan Stok --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Dosis per Hari</label>
                        <input type="number" name="dosis_per_hari" class="form-control rounded-pill"
                            value="{{ old('dosis_per_hari', $obat->dosis_per_hari ?? 1) }}" min="1" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Stok Awal</label>
                        <input type="number" name="stock" class="form-control rounded-pill"
                            value="{{ old('stock', $obat->stock) }}" min="0" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Stok Terpakai</label>
                        <input type="number" name="stok_terpakai" class="form-control rounded-pill"
                            value="{{ old('stok_terpakai', $obat->stok_terpakai ?? 0) }}" min="0" required>
                    </div>
                </div>

                {{-- Kadar / Ukuran --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kadar / Ukuran Obat</label>
                    <input type="text" name="kadar" class="form-control rounded-pill"
                        placeholder="cth: 500 mg / 100 ml"
                        value="{{ old('kadar', $obat->kadar ?? '') }}">
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-save2 me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('obat.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tambahkan Bootstrap Icons --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush
@endsection
