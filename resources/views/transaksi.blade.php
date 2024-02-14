@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Daftar Transaksi</h2>
        <button type="button" class="btn btn-primary" id="modalOpen" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Transaksi Baru</a>
        </button>
    </div>

    <div class="justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-auto alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('failed'))
            <div class="alert alert-danger col-lg-auto alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    @include('dashboard.transaksi.create')
    <div class="mb-4 small" id="scrollX">
        <table class="table table-striped table-hover align-middle small" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col" class="text-center">Kode Proyek</th>
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
                        <td class="text-center">{{ $post->project->episode }}</td>
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
