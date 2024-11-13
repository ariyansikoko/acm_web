@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pengeluaran Proyek</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="modalOpen">Tambah
            Transaksi Baru</button>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('dashboard.transaksi.create')

    <div class="table-responsive small overflow-auto mt-3 mb-4" id="scrollX">

        <table class="table table-striped table-sm align-middle table-hover" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Proyek</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Kasbon</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori Biaya</th>
                    <th scope="col">Jenis Biaya</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->transaction_date)->format('d M Y') }}</td>
                        <td><b>{{ $post->project->title }}</b></td>
                        <td>{{ $post->recipient->name }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->amount) }}</td>
                        <td style="width: 35%">{{ $post->description }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->expensetype->name }}</td>
                        <td class="no-wrap">
                            <a href="/dashboard/pengeluaran/{{ $post->id }}" class="btn btn-success btn-sm"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                <i class="bi bi-eye"></i></a>
                            <a href="/dashboard/pengeluaran/{{ $post->id }}/edit" class="btn btn-warning btn-sm"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/pengeluaran/{{ $post->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Are you sure?')"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $("#modalOpen").on("click", function() {
            // Open the modal
            $('#exampleModal').modal('show');
        });
    </script>
@endsection
