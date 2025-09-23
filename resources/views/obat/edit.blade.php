@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Obat</h2>

    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Obat</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $obat->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $obat->jenis) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Bentuk</label>
            <input type="text" name="bentuk" class="form-control" value="{{ old('bentuk', $obat->bentuk) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori / Dosis</label>
            <input type="text" name="kategori_dosis" class="form-control" value="{{ old('kategori_dosis', $obat->kategori_dosis) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $obat->stock) }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
