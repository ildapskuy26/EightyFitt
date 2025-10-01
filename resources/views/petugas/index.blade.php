@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Kelola Petugas</h3>
    <a href="{{ route('petugas.create') }}" class="btn btn-primary mb-3">Tambah Petugas</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($petugas as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>
                    <a href="{{ route('petugas.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('petugas.destroy', $p) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus petugas ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $petugas->links() }}
</div>
@endsection
