@extends('layouts.main')

@section('body')
    <h1 class="mb-4 text-center">Daftar Transaksi</h1>

    <div class="mb-4">
        <table class="table table-striped table-hover align-middle small" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Proyek</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Pengeluaran/Debit</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori Biaya</th>
                    <th scope="col">Jenis Biaya</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $post)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($post->requested_at)->format('d M Y') }}</td>
                        {{-- <td>{{ $post->requested_at }}</td> --}}
                        <td>{{ $post->project->title }}</td>
                        <td>{{ $post->recipient->name }}</td>
                        <td>{{ formatRupiah($post->amount) }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->expensetype->name }}</td>
                        <td>
                            <a href="/pengeluaran/{{ $post->expense_id }}" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
