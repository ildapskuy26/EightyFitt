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
            <label for="nama_obat">Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
