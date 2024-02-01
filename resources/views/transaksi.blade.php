@extends('layouts.main')

@section('body')
    <h1 class="mb-4 text-center">{{ $title }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/pengeluaran" method="GET">
                @if (request('project'))
                    <input type="hidden" name="project" value="{{ request('project') }}">
                @endif
                @if (request('recipient'))
                    <input type="hidden" name="project" value="{{ request('recipient') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($transaksi->count())
        <div class="table-responsive small">
            <table class="table table-striped table-hover mt-4 align-middle table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Proyek</th>
                        <th scope="col">Penerima</th>
                        <th scope="col">Pengeluaran/Debit</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Kategori Biaya</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->requested_at }}</td>
                            <td>{{ $post->project->title }}</td>
                            <td>{{ $post->recipient->name }}</td>
                            <td>{{ formatRupiah($post->amount) }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->category }}</td>
                            <td>
                                <a href="/pengeluaran/{{ $post->expense_id }}" class="btn btn-sm btn-success"><i
                                        class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="col mt-5 text-center">
            <h3>No Data Found.</h3>
        </div>
    @endif

    <div class="d-flex justify-content-end">{{ $transaksi->links() }}</div>

@endsection
