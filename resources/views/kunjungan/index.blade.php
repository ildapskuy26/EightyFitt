@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📋 Data Kunjungan</h3>
    <div class="d-flex">
        <a href="{{ route('kunjungan.create') }}" class="btn btn-primary me-2">
            ➕ Tambah Kunjungan
        </a>
        <a href="{{ route('kunjungan.export.csv') }}" class="btn btn-success me-2">
            ⬇️ Download CSV
        </a>
        <!-- Tombol Filter -->
        <button type="button" onclick="openFilterModal()" 
            class="bg-success hover:bg-success-dark text-white px-3 py-2 rounded d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 
                    6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 
                    00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Filter
        </button>
    </div>
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
        @forelse($kunjungan as $k)
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
        @empty
        <tr>
            <td colspan="10" class="text-center">Tidak ada data kunjungan</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filter Data Kunjungan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="GET" action="{{ route('kunjungan.index') }}">
          <div class="modal-body">
              <div class="mb-3">
                  <label for="kelas" class="form-label">Kelas</label>
                  <input type="text" name="kelas" id="kelas" class="form-control"
                         value="{{ request('kelas') }}" placeholder="Misal: X, XI, XII">
              </div>
              <div class="mb-3">
                  <label for="jurusan" class="form-label">Jurusan</label>
                  <input type="text" name="jurusan" id="jurusan" class="form-control"
                         value="{{ request('jurusan') }}" placeholder="Misal: RPL, TKJ">
              </div>
              <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal Kedatangan</label>
                  <input type="date" name="tanggal" id="tanggal" class="form-control"
                         value="{{ request('tanggal') }}">
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Terapkan</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
    function openFilterModal() {
        var modal = new bootstrap.Modal(document.getElementById('filterModal'));
        modal.show();
    }
</script>
@endsection
