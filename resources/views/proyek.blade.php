@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Daftar Proyek</h2>
        <a href="/dashboard/proyek/create" class="btn btn-primary">Tambah Proyek Baru</a>
    </div>
    <div class="mb-4 small" id="scrollX">
        <table class="table table-striped table-hover align-middle" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Proyek</th>
                    <th scope="col" class="text-center">Area Kerja</th>
                    <th scope="col">Jenis Proyek</th>
                    <th scope="col" class="no-wrap">Nama Pekerjaan</th>
                    <th scope="col">Nilai BOQ Plan</th>
                    <th scope="col">Nilai BOQ Aktual</th>
                    <th scope="col">Nilai Comcase</th>
                    <th scope="col">Nilai BOQ-Comcase</th>
                    <th scope="col">Nilai BOQ Subcon</th>
                    <th scope="col">No PO</th>
                    <th scope="col">Keterangan BOQ</th>
                    <th scope="col" class="text-center">EP</th>
                    <th scope="col" class="text-center">Status Budget</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td class="text-center"><b>{{ $post->project_id }}</b></td>
                        <td>{{ $post['project_area'] }}{{ $post['project_location'] != null ? ',' : '' }}
                            {{ $post['project_location'] }}</td>
                        <td>{{ $post['type'] }}</td>
                        <td><b>{{ $post['title'] }}</b></td>
                        <td class="no-wrap">{{ formatRupiah($post['boq_plan']) }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->boq_actual) }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->comcase) }}</td>
                        @if ($post->boq_actual != 0)
                            <td class="no-wrap">{{ formatRupiah($post->boq_actual - $post->comcase) }}</td>
                        @else
                            <td class="no-wrap">{{ formatRupiah($post->boq_plan - $post->comcase) }}</td>
                        @endif
                        <td class="no-wrap">{{ formatRupiah($post['boq_subcon']) }}</td>
                        <td>{{ $post->no_po }}</td>
                        <td>{{ $post['boq_desc'] }}</td>
                        <td>{{ $post['episode'] }}</td>
                        @if ($post->status == 1)
                            <td class="text-success text-center"><b>OPEN</b></td>
                        @else
                            <td class="text-danger text-center"><b>CLOSED</b></td>
                        @endif
                        <td class="no-wrap">
                            @if ($post->boq_plan == 0 || $post->boq_actual == 0 || $post->no_po == null)
                                <a href="/proyek/{{ $post->project_id }}" class="btn btn-success btn-sm"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-eye"></i>
                                </a> <a href="/dashboard/proyek/{{ $post->project_id }}/edit"
                                    class="btn btn-warning btn-sm"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-pencil-square"></i></a>
                            @else
                                <a href="/proyek/{{ $post->project_id }}" class="btn btn-success btn-sm"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Summary
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
                },
                {
                    targets: [3, 7, 8, 10, 11, 13],
                    visible: false,
                },
            ],
            "dom": '<"container-fluid"<"row"<"col"B><"col"f>>>t<"container-fluid mt-4"<"row"<"col"l><"col"p>>>',
            "buttons": [
                'print', 'excel', 'pdf',
                {
                    extend: 'colvis',
                    columns: 'th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(5)):not(:nth-child(15))'
                }
            ],
            "pageLength": 10,
            "order": [0, 'desc'],
            "autoWidth": false,
        });
    </script>
@endsection
