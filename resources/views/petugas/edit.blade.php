@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Petugas</h3>

    <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $petugas->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" 
                   value="{{ old('email', $petugas->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('petugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
