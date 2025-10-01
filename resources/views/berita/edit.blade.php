@extends('layouts.app')

@section('content')
<h3 class="mb-4">Edit Berita</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Ada masalah dengan inputan kamu.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Input Judul --}}
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
    </div>


    {{-- Input Isi --}}
    <div class="mb-3">
        <label for="isi" class="form-label">Isi Berita</label>
        <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $berita->isi) }}</textarea>
    </div>

    {{-- Input Gambar --}}
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" name="gambar" class="form-control">
        @if($berita->gambar)
            <small class="text-muted">Gambar saat ini: {{ $berita->gambar }}</small>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection