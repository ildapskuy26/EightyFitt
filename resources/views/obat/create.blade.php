@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Obat</h2>

    {{-- tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- form tambah obat --}}
    <form action="{{ route('obat.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nama">Nama Obat</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
    <label class="form-label">Jenis</label>
    <select name="jenis_obat" class="form-control">
    <option value="">- Pilih Jenis -</option>
    <option value="Antibiotik" {{ old('jenis_obat') == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
    <option value="Analgesik" {{ old('jenis_obat') == 'Analgesik' ? 'selected' : '' }}>Analgesik</option>
    <option value="Antipiretik" {{ old('jenis_obat') == 'Antipiretik' ? 'selected' : '' }}>Antipiretik</option>
    <!-- Tambahkan jenis lain sesuai kebutuhan -->
</select>
        </div>

        <div class="mb-3">
            <label class="form-label">Bentuk</label>
<select name="bentuk_obat" class="form-control">
    <option value="">- Pilih Bentuk -</option>
    <option value="Tablet" {{ old('bentuk_obat') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
    <option value="Sirup" {{ old('bentuk_obat') == 'Sirup' ? 'selected' : '' }}>Sirup</option>
    <option value="Kapsul" {{ old('bentuk_obat') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
    <!-- Tambahkan bentuk lain sesuai kebutuhan -->
</select>
        </div>

        <div class="form-group mb-3">
    <label for="dosis_per_hari">Dosis/Hari</label>
    <input type="number" name="dosis_per_hari" class="form-control" value="{{ old('dosis_per_hari', 1) }}" min="1" required>
</div>

        <div class="form-group mb-3">
            <label for="stock">Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required min="0">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
