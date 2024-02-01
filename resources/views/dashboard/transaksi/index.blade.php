@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Data Pengeluaran Proyek</h2>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive small">
        <a href="/dashboard/pengeluaran/create" class="btn btn-primary mb-3">Tambah Data</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->expense_id }}</td>
                        <td>{{ $post->requested_at }}</td>
                        <td>{{ $post->project->title }}</td>
                        <td>{{ $post->recipient->name }}</td>
                        <td>{{ $post->amount }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->type }}</td>
                        <td>
                            <a href="/dashboard/transaksi/{{ $post->expense_id }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i>
                            </a><a href="/dashboard/transaksi/{{ $post->expense_id }}/edit" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/transaksi/{{ $post->expense_id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
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
