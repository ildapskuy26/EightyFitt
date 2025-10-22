@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5 animate-fade-in" style="max-width: 650px; width: 100%;">
        <div class="text-center mb-4">
            <div class="icon-circle bg-gradient-green text-white mb-3">
                <i class="bi bi-capsule fs-3"></i>
            </div>
            <h3 class="fw-bold text-gradient mb-1">Tambah Data Obat</h3>
            <p class="text-muted mb-0">Isi data dengan benar untuk menambahkan obat baru</p>
        </div>

        {{-- tampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- form tambah obat --}}
        <form action="{{ route('obat.store') }}" method="POST" class="mt-4">
            @csrf

            {{-- Nama Obat --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Obat</label>
                <input type="text" name="nama" class="form-control form-control-lg rounded-3 shadow-sm"
                    value="{{ old('nama') }}" placeholder="Masukkan nama obat" required>
            </div>

            {{-- Jenis Obat --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis</label>
                <select name="jenis_obat" class="form-select form-select-lg rounded-3 shadow-sm" required>
                    <option value="">- Pilih Jenis -</option>
                    <option value="Antibiotik" {{ old('jenis_obat') == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
                    <option value="Analgesik" {{ old('jenis_obat') == 'Analgesik' ? 'selected' : '' }}>Analgesik</option>
                    <option value="Antipiretik" {{ old('jenis_obat') == 'Antipiretik' ? 'selected' : '' }}>Antipiretik</option>
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

            {{-- Dosis & Stok --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Dosis/Hari</label>
                    <input type="number" name="dosis_per_hari" class="form-control form-control-lg rounded-3 shadow-sm"
                        value="{{ old('dosis_per_hari', 1) }}" min="1" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Stok Awal</label>
                    <input type="number" name="stock" class="form-control form-control-lg rounded-3 shadow-sm"
                        value="{{ old('stock') }}" min="0" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Stok Terpakai</label>
                    <input type="number" name="stok_terpakai" class="form-control form-control-lg rounded-3 shadow-sm"
                        value="{{ old('stok_terpakai', 0) }}" min="0" required>
                </div>
            </div>

            {{-- Kadar / Ukuran --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kadar / Ukuran Obat</label>
                <input type="text" name="kadar" class="form-control form-control-lg rounded-3 shadow-sm"
                    placeholder="cth: 500 mg / 100 ml" value="{{ old('kadar') }}">
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('obat.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 btn-hover-animate">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm btn-hover-animate">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Animasi lembut masuk */
.animate-fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
}
@keyframes fadeInUp {
    to { opacity: 1; transform: translateY(0); }
}

/* Card form styling */
.card {
    background: #fff;
}

/* Icon lingkaran */
.icon-circle {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* Gradient warna */
.bg-gradient-green {
    background: linear-gradient(135deg, #0d6efd, #20c997);
}

/* Teks gradasi */
.text-gradient {
    background: linear-gradient(90deg, #0d6efd, #20c997);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Efek hover tombol */
.btn-hover-animate {
    transition: all 0.25s ease;
}
.btn-hover-animate:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Fokus input */
.form-control:focus, .form-select:focus {
    border-color: #20c997;
    box-shadow: 0 0 0 0.25rem rgba(32, 201, 151, 0.25);
}

/* Responsif */
@media (max-width: 576px) {
    .card {
        padding: 2rem;
    }
}
</style>
@endsection
