@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pengeluaran Proyek</h1>
    </div>
    <div class="mb-3">
        <a href="/dashboard/pengeluaran" class="btn btn-primary">
            <i class="bi bi-caret-left-fill"></i> Kembali</a>
        <a href="/dashboard/pengeluaran/{{ $transaksi->id }}/edit" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit</a>
        <form action="/dashboard/pengeluaran/{{ $transaksi->id }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
    </div>

    <div class="col-md-8">
        <table class="table table-hover table-striped-columns table-bordered">
            <tr>
                <td>Nama Project</td>
                <td><b>{{ $transaksi->project->project_id }} - {{ $transaksi->project->title }}</b>
                    @if ($transaksi->project->status == 1)
                        , <b class="text-success">OPEN</b>
                    @else
                        , <b class="text-danger">CLOSED</b>
                    @endif
                </td>

            </tr>
            <tr>
                <td>Tanggal</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->transaction_date)->format('D, d M Y') }}</td>
            </tr>
            <tr>
                <td>Penerima</td>
                <td>{{ $transaksi->recipient->name }}</td>
            </tr>
            <tr>
                <td>Pengeluaran/Debit</td>
                <td>{{ formatRupiah($transaksi->amount) }}</td>
            </tr>
            <tr>
                <td>Kategori Biaya</td>
                <td>{{ $transaksi->category }}</td>
            </tr>
            <tr>
                <td>Jenis Biaya</td>
                <td>{{ $transaksi->expensetype->name }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>{{ $transaksi->description }}</td>
            </tr>
        </table>
    </div>
@endsection
