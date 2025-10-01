@extends('layouts.app')

@section('content')
<h3>Tambah Kunjungan</h3>

<form action="{{ route('kunjungan.store') }}" method="POST">
    @csrf
<div class="mb-3">
    <label>NIS Siswa</label>
    <select name="nis" id="nis" class="form-select" required>
        <option value="">-- Pilih Siswa --</option>
        @foreach($siswa as $s)
            <option value="{{ $s->nis }}">{{ $s->nis }} - {{ $s->nama }}</option>
        @endforeach
    </select>
</div>

    <div class="mb-3">
        <label>Waktu Kedatangan</label>
        <input type="datetime-local" name="waktu_kedatangan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Waktu Keluar</label>
        <input type="datetime-local" name="waktu_keluar" class="form-control">
    </div>

    <div class="mb-3">
        <label>Keluhan</label>
        <textarea name="keluhan" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Obat yang Diberikan</label>
        <select name="obat_id" class="form-select">
            <option value="">-- Tidak Ada --</option>
            @foreach($obat as $o)
            <option value="{{ $o->id }}">{{ $o->nama }} ({{ $o->kategori_dosis }})</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">Kembali</a>
</form>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#nis').select2({
            placeholder: "-- Pilih Siswa --",
            allowClear: true
        });
    });
</script>

@endsection
