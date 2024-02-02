@extends('layouts.main')

@section('body')
    <h1>Detail Pengeluaran</h1>
    <table class="table table-hover table-striped-columns table-bordered">
        <tr>
            <td>Nama Project</td>
            <td><a href="/pengeluaran?project={{ $transaksi->project->slug }}"
                    class="text-decoration-none">{{ $transaksi->project->title }}</a>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>{{ \Carbon\Carbon::parse($transaksi->requested_at)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td>Penerima</td>
            <td><a href="/pengeluaran?recipient={{ $transaksi->recipient->slug }}"
                    class="text-decoration-none">{{ $transaksi->recipient->name }}</a></td>
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

    <a href="/pengeluaran" class="btn btn-primary">Kembali</a>
@endsection
