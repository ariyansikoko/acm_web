@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pengeluaran Proyek</h1>
    </div>
    <div class="mb-3">
        <a href="/dashboard/pengeluaran" class="btn btn-success">
            <i class="bi bi-caret-left-fill"></i> Kembali</a>
        <a href="/dashboard/pengeluaran/{{ $transaksi->expense_id }}/edit" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit</a>
        <form action="/dashboard/pengeluaran/{{ $transaksi->expense_id }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
    </div>

    <table class="table table-hover table-striped-columns table-bordered">
        <tr>
            <td>Nama Project</td>
            <td>{{ $transaksi->project->title }}
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>{{ \Carbon\Carbon::parse($transaksi->requested_at)->format('d M Y') }}</td>
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
            <td>{{ $transaksi->type }}</td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>{{ $transaksi->description }}</td>
        </tr>
    </table>
@endsection
