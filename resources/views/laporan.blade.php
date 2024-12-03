@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Laporan Proyek TA</h2>
    </div>
    <div class="mb-4 small" id="scrollX">
        <table class="table table-striped table-hover align-middle" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal</th>
                    <th scope="col" class="text-center">Area Pekerjaan</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Nilai BOQ Plan</th>
                    <th scope="col">Nilai BOQ Aktual</th>
                    <th scope="col">Biaya Perusahaan</th>
                    <th scope="col">DP Subcon</th>
                    <th scope="col">Laba/Rugi</th>
                    <th scope="col">Episode</th>
                    <th scope="col" class="text-center">Status Budget</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td class="text-center">
                            {{ $post['project_area'] }}{{ $post['project_location'] != null ? ',' : '' }}
                            {{ $post['project_location'] }}</td>
                        <td><b>{{ $post['title'] }}</b></td>
                        <td class="no-wrap">{{ formatRupiah($post['boq_plan']) }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->boq_actual) }}</td>
                        @php
                            $biaya = $post->transaction->where('category', 'Biaya Perusahaan')->sum('amount');
                        @endphp
                        <td class="no-wrap">{{ formatRupiah($biaya) }}</td>
                        @php
                            $subcon = $post->transaction->where('category', 'DP Subcon')->sum('amount');
                        @endphp
                        <td class="no-wrap">{{ formatRupiah($subcon) }}</td>
                        @if ($post->boq_actual != 0)
                            @php
                                $laba = $post->boq_actual - $biaya - $subcon;
                            @endphp
                        @else
                            @php
                                $laba = $post->boq_plan - $biaya - $subcon;
                            @endphp
                        @endif
                        <td class="{{ $laba > 0 ? 'text-success' : 'text-danger' }} no-wrap">
                            <b>{{ formatRupiah($laba) }}</b>
                        </td>

                        <td class="text-center"> {{ $post->episode }}</td>
                        <td class="text-center">
                            @if ($post->status == 1)
                                <b class="text-success">OPEN</b>
                            @else
                                <b class="text-danger">CLOSED</b>
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
            }],
            "dom": '<"container-fluid"<"row"<"col"B><"col"f>>>rt<"container-fluid mt-4"<"row"<"col"l><"col"p>>>',
            "buttons": [
                'print', 'excel', 'pdf'
            ],
            "pageLength": 10,
            "order": [0, 'desc'],
        });
    </script>
@endsection
