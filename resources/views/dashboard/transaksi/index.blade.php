@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pengeluaran Proyek</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive small overflow-auto">
        <a href="/dashboard/pengeluaran/create" class="btn btn-primary mb-3">Tambah Transaksi Baru</a>
        <table class="table table-striped table-sm align-middle table-hover">
            <thead>
                <tr class="align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Proyek</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Pengeluaran<br>/Debit</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori Biaya</th>
                    <th scope="col">Jenis Biaya</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $post)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ \Carbon\Carbon::parse($post->requested_at)->format('d M Y') }}</td>
                        <td>{{ $post->project->title }}</td>
                        <td>{{ $post->recipient->name }}</td>
                        <td>{{ formatRupiah($post->amount) }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->type }}</td>
                        <td>
                            <a href="/dashboard/pengeluaran/{{ $post->expense_id }}" class="btn btn-success btn-sm">
                                <i class="bi bi-eye"></i></a>
                            <a href="/dashboard/pengeluaran/{{ $post->expense_id }}/edit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/pengeluaran/{{ $post->expense_id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
