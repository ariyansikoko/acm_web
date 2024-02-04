@extends('layouts.main')

@section('body')
    <h1 class="mb-4 text-center">Detail Pengeluaran</h1>
    <div class="">
        <table class="table table-hover table-striped-columns table-bordered">
            <tr>
                <td>Nama Project</td>
                <td>{{ $transaksi->project->title }}</td>
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
                <td>{{ $transaksi->expensetype->name }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>{{ $transaksi->description }}</td>
            </tr>
        </table>
    </div>

    <a href="/pengeluaran" class="btn btn-primary">Kembali</a>
@endsection
