@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h4>Profil Siswa</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('siswa.profile.password') }}">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input class="form-control" value="{{ $siswa->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label for="current_password">Password Saat Ini (opsional)</label>
                <input id="current_password" type="password" name="current_password" class="form-control">
                <small class="text-muted">Boleh dikosongkan jika awal login password = NIS dan kamu ingin langsung ganti.</small>
            </div>

            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-success">Simpan Password Baru</button>
        </form>
    </div>
</div>
@endsection
