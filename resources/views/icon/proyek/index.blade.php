@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Daftar Pekerjaan ICON</h2>
        <div class="">
            <button type="button" class="btn btn-primary" id="modalOpen" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Pekerjaan Baru</a>
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show mx-auto" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('failed'))
        <div class="alert alert-danger col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('icon.proyek.create')

    <div class="mb-4 small" id="scrollX">
        <table class="table table-bordered small" id="dataTable">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" class="no-wrap">WILAYAH</th>
                    <th scope="col" class="no-wrap">TANGGAL</th>
                    <th scope="col" class="no-wrap">NO PA</th>
                    <th scope="col" class="no-wrap">NAMA PEKERJAAN</th>
                    <th scope="col" class="no-wrap">NILAI PKB AWAL</th>
                    <th scope="col" class="no-wrap">NILAI PKB AKHIR</th>
                    <th scope="col" class="text-center">AKSI</th>
                    <th scope="col" class="text-center">PENGELUARAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->location }}</td>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($project->project_date)->format('d M Y') }}</td>
                        <td>{{ $project->no_pa }}</td>
                        <td><b><a href="/icon/proyek/{{ $project->id }}"
                                    style="color: #00008B;">{{ $project->title }}</a></b>
                        </td>
                        <td class="no-wrap text-end">{{ formatRupiah($project->pkb_initial) }}</td>
                        <td class="no-wrap text-end">{{ formatRupiah($project->pkb_final) }}</td>
                        <td class="no-wrap">
                            <a href="{{ route('icon_transaction.create', $project->id) }}" class="btn btn-sm btn-success">
                                <i class="bi bi-currency-dollar"></i></a>
                            <a href="/icon/proyek/{{ $project->id }}/edit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/icon/proyek/{{ $project->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Apakah yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td style="padding: 0">
                            @if ($project->iconTransaction->isNotEmpty())
                                <table class="table small" style="margin: 0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">JUMLAH</th>
                                            <th scope="col" class="text-end no-wrap">NO PENGAJUAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->iconTransaction as $transaction)
                                            @if ($transaction->icon_project_id === $project->id)
                                                <tr>
                                                    <td class="no-wrap text-end">{{ formatRupiah($transaction['amount']) }}
                                                    </td>
                                                    <td class="text-end">{{ $transaction['no'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center" style="margin: 5px">Tidak ada pengeluaran</div>
                            @endif
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
    <script>
        var table = new DataTable('#dataTable', {
            "columnDefs": [{
                "type": "date-eu",
                "targets": 2, // Assuming the date column is the second column (index 1)
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
            "dom": '<"container-fluid"<"row"<"col"><"col mb-3"f>>>rt<"container-fluid mt-4"<"row"<"col"i><"col"p>>>',
            "pageLength": 10,
            "order": [0, 'asc'],
        });
    </script>
@endsection
