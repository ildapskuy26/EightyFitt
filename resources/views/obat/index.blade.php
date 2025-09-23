@extends('layouts.app')

@section('content')
<h3>Inventaris Obat</h3>

<a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">Tambah Obat</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Bentuk</th>
            <th>Kategori / Dosis</th>
            <th>Stock</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($obat as $o)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $o->nama }}</td>
            <td>{{ $o->jenis ?? '-' }}</td>
            <td>{{ $o->bentuk ?? '-' }}</td>
            <td>{{ $o->kategori_dosis ?? '-' }}</td>
            <td>{{ $o->stock }}</td>
            <td>
                <a href="{{ route('obat.edit', $o->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('obat.destroy', $o->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
