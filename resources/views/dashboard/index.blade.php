@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome! {{ auth()->user()->name }}</h1>
    </div>
    <p>Ini adalah halaman Dashboard untuk melakukan modifikasi pada database</p>
@endsection
