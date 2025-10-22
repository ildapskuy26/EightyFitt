@extends('layouts.app')

@section('content')
<!-- Tambahkan Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* === FORM TAMBAH BERITA MODERN === */
    body {
        background: linear-gradient(135deg, #e0f7fa 0%, #e3f2fd 100%);
        min-height: 100vh;
    }

    .form-wrapper {
        max-width: 750px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        padding: 45px 40px;
        position: relative;
        overflow: hidden;
    }

    .form-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 5px;
        width: 100%;
        background: linear-gradient(90deg, #00bfa6, #2196f3);
    }

    .form-wrapper h2 {
        font-weight: 700;
        font-size: 1.9rem;
        color: #0f172a;
        margin-bottom: 30px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    label {
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control {
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        transition: all 0.25s ease;
    }

    .form-control:focus {
        border-color: #00bfa6;
        box-shadow: 0 0 0 3px rgba(0, 191, 166, 0.15);
    }

    .btn-primary {
        background: linear-gradient(90deg, #00bfa6, #2196f3);
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 10px 25px;
        color: white;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #1e293b;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 10px 25px;
        transition: 0.3s ease;
    }

    .btn-secondary:hover {
        background: #cbd5e1;
    }

    .alert-danger {
        border-radius: 12px;
    }
</style>

<div class="form-wrapper">
    <h2><i class="fa-solid fa-newspaper text-primary"></i> Tambah Berita</h2>

    {{-- === ERROR VALIDASI === --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">
                <i class="fa-solid fa-heading text-teal-600"></i> Judul Berita
            </label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul berita..." required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">
                <i class="fa-solid fa-pen-to-square text-blue-500"></i> Isi Berita
            </label>
            <textarea name="isi" id="isi" class="form-control" rows="6" placeholder="Tulis isi berita di sini..." required></textarea>
        </div>

        <div class="mb-4">
            <label for="gambar" class="form-label">
                <i class="fa-solid fa-image text-indigo-500"></i> Gambar (Opsional)
            </label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection
