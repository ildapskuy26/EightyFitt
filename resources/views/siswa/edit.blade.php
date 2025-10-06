{{-- filepath: c:\Users\UYTTR\Desktop\EightyFit\EightyFit\EightyFitt\resources\views\siswa\edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Edit Siswa</h3>
    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $siswa->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $siswa->email }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('petugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection