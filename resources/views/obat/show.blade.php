@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Obat</h2>

    <p><strong>Nama:</strong> {{ $obat->nama }}</p>
    <p><strong>Jenis:</strong> {{ $obat->jenis }}</p>
    <p><strong>Bentuk:</strong> {{ $obat->bentuk }}</p>
    <p><strong>Kategori Dosis:</strong> {{ $obat->kategori_dosis }}</p>
    <p><strong>Stock:</strong> {{ $obat->stock }}</p>

    <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
