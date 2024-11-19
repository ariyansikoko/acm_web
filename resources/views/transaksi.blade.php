@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Daftar Transaksi TA</h2>
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
                    <th scope="col" class="text-center no-wrap">Kode Proyek</th>
                    <th scope="col">Nama Proyek</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Kasbon</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" class="no-wrap">Kategori Biaya</th>
                    <th scope="col">Jenis Biaya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->transaction_date)->format('d M Y') }}</td>
                        <td><b>{{ $post->project->project_id }}</b></td>
                        <td><b>{{ $post->project->title }}</b></td>
                        <td>{{ $post->recipient->name }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->amount) }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->expensetype->name }}</td>
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
    <script>
        var table = new DataTable('#dataTable', {
            "columnDefs": [{
                "type": "date-eu",
                "targets": 0, // Assuming the date column is the second column (index 1)
                "render": function(data, type, row, meta) {
                    if (type === 'sort') {
                        // Convert the date to a format that can be sorted naturally
                        return new Date(data).toISOString();
                    }

                    // Display the date in the "dd MMMM YYYY" format (full month name)
                    const date = new Date(data);
                    const day = date.toLocaleString('en-US', {
                        day: '2-digit'
                    });
                    const month = date.toLocaleString('en-US', {
                        month: 'short'
                    });
                    const year = date.toLocaleString('en-US', {
                        year: 'numeric'
                    });

                    return `${day} ${month} ${year}`;
                }
            }],
            "dom": '<"container-fluid"<"row"<"col"B><"col"f>>>rt<"container-fluid mt-4"<"row"<"col"i><"col"p>>>',
            "buttons": [
                'print', 'excel', 'pdf'
            ],
            "pageLength": 15,
            "order": [0, 'desc'],
        });
    </script>
@endsection
