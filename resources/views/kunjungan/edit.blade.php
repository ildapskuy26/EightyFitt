@extends('layouts.app')

@section('content')
<h3>✏️ Edit Kunjungan</h3>

<form action="{{ route('kunjungan.update', $kunjungan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>NIS Siswa</label>
        <select name="nis" id="nis" class="form-select" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $s)
                <option value="{{ $s->nis }}" {{ $kunjungan->nis == $s->nis ? 'selected' : '' }}>
                    {{ $s->nis }} - {{ $s->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Waktu Kedatangan</label>
        <input type="datetime-local" name="waktu_kedatangan" class="form-control"
            value="{{ \Carbon\Carbon::parse($kunjungan->waktu_kedatangan)->format('Y-m-d\TH:i') }}" required>
    </div>

    <div class="mb-3">
        <label>Waktu Keluar</label>
        <input type="datetime-local" name="waktu_keluar" class="form-control"
            value="{{ $kunjungan->waktu_keluar ? \Carbon\Carbon::parse($kunjungan->waktu_keluar)->format('Y-m-d\TH:i') : '' }}">
    </div>

    <div class="mb-3">
        <label>Keluhan</label>
        <textarea name="keluhan" class="form-control">{{ $kunjungan->keluhan }}</textarea>
    </div>

    <div class="mb-3">
        <label>Obat yang Diberikan</label>
        <select name="obat_id" class="form-select">
            <option value="">-- Tidak Ada --</option>
            @foreach($obat as $o)
                <option value="{{ $o->id }}" {{ $kunjungan->obat_id == $o->id ? 'selected' : '' }}>
                    {{ $o->nama }} ({{ $o->kategori_dosis }})
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">💾 Update</button>
    <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
</form>

{{-- Select2 untuk dropdown siswa --}}
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
