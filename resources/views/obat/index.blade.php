@extends('layouts.app')

@section('content')
<h3>Inventaris Obat</h3>

{{-- ✅ Tombol tambah obat hanya muncul kalau admin/petugas --}}
@if(in_array(Auth::user()->role, ['admin','petugas']))
    <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">Tambah Obat</a>
@endif

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
            <th>Dosis/Hari</th>
            <th>Stock</th>
            @if(in_array(Auth::user()->role, ['admin','petugas']))
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($obat as $o)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $o->nama }}</td>
            <td>{{ $o->jenis_obat ?? '-' }}</td>
            <td>{{ $o->bentuk_obat ?? '-' }}</td>
            <td>{{ $o->dosis_per_hari ?? '-' }}</td>
            <td>{{ $o->stock }}</td>

            {{-- ✅ Hanya admin/petugas bisa edit/hapus --}}
            @if(in_array(Auth::user()->role, ['admin','petugas']))
            <td>
                <a href="{{ route('obat.edit', $o->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('obat.destroy', $o->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
