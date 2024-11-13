@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Karyawan</h1>
        <div class="">
            <a href="/dashboard/karyawanNonaktif" class="btn btn-secondary">Daftar Karyawan Nonaktif</a>
            <a href="/dashboard/karyawan/create" class="btn btn-primary">Tambah Karyawan Baru</a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
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

    <div class="table table-responsive mt-3 mb-4">
        <table class="table table-striped align-middle table-hover table-sm small" id="tabelkaryawan">
            <thead>
                <tr class="align-middle">
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Tanggal Mulai Kerja</th>
                    <th scope="col">Lokasi Kerja</th>
                    <th scope="col">Bagian</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employee as $post)
                    <tr>
                        <td>{{ $post->employee_id }}</td>
                        <td>{{ $post->name }}</td>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->birth_date)->format('d-M-Y') }}</td>
                        <td>{{ $post->phone_number }}</td>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->start_date)->format('d-M-Y') }}</td>
                        <td>{{ $post->work_location }}</td>
                        <td>{{ $post->department }}</td>
                        <td>{{ $post->position->title }}</td>
                        <td>
                            <a href="/dashboard/karyawan/{{ $post->id }}" class="btn btn-success btn-sm">
                                <i class="bi bi-eye"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        var table = new DataTable('#tabelkaryawan', {
            "columnDefs": [{
                "type": "date-eu",
                "targets": [2, 4], // Assuming the date column is the second column (index 1)
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
            "dom": '<"container-fluid"<"row"<"col"B><"col"f>>>t<"container-fluid mt-4"<"row"<"col"i><"col"p>>>',
            "buttons": [
                'csv', 'excel', 'pdf',
            ],
            "pagingType": 'numbers',
            "pageLength": 15,
            "order": [1, 'asc'],
        });
    </script>
@endsection
