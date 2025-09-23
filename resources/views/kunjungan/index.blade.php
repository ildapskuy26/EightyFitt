@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Kunjungan</h3>
    <a href="{{ route('kunjungan.create') }}" class="btn btn-primary">Tambah Kunjungan</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Waktu Kedatangan</th>
            <th>Waktu Keluar</th>
            <th>Keluhan</th>
            <th>Obat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kunjungan as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->nis }}</td>
            <td>{{ $k->nama }}</td>
            <td>{{ $k->kelas }}</td>
            <td>{{ $k->jurusan }}</td>
            <td>{{ $k->waktu_kedatangan }}</td>
            <td>{{ $k->waktu_keluar ?? '-' }}</td>
            <td>{{ $k->keluhan ?? '-' }}</td>
            <td>{{ $k->obat->nama ?? '-' }}</td>
            <td>
                <a href="{{ route('kunjungan.edit',$k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('kunjungan.destroy',$k->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data kunjungan?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
