@extends('layouts.app')

@section('content')
<h1>Dashboard Admin</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="card mt-3">
    <div class="card-body">
        <h5>Menu Admin</h5>
        <ul>
            <li><a href="#">Kelola User</a></li>
            <li><a href="#">Laporan</a></li>
        </ul>
    </div>
</div>
@endsection
