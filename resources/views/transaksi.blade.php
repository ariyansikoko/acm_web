@extends('layouts.main')

@section('body')
    <h2 class="mb-4">Daftar Transaksi</h2>

    <div class="mb-4 small">
        <table class="table table-striped table-hover align-middle small" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Proyek</th>
                    <th scope="col">Nama Proyek</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Kasbon</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori Biaya</th>
                    <th scope="col">Jenis Biaya</th>
                    <th scope="col">Episode</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->transaction_date)->format('d M Y') }}</td>
                        <td>{{ $post->project->project_id }}</td>
                        <td><b>{{ $post->project->title }}</b></td>
                        <td>{{ $post->recipient->name }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->amount) }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->expensetype->name }}</td>
                        <td>{{ $post->project->episode }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
