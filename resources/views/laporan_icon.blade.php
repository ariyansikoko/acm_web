@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Laporan Proyek Icon</h2>
    </div>
    <div class="mb-4 small" id="scrollX">
        <table class="table table-striped table-hover align-middle" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal Order</th>
                    <th scope="col">Wilayah</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">No PA</th>
                    <th scope="col">PKB Awal</th>
                    <th scope="col">PKB Akhir</th>
                    <th scope="col">Total Pengeluaran</th>
                    <th scope="col">Laba/Rugi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td>{{ $post->location }}</td>
                        <td><b>{{ $post['title'] }}</b></td>
                        <td class="no-wrap">{{ $post->no_pa }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->pkb_initial) }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->pkb_final) }}</td>
                        @php
                            $expense = $post->iconTransaction->sum('amount');
                        @endphp
                        <td class="no-wrap">{{ formatRupiah($expense) }}</td>
                        @if ($post->pkb_final != 0)
                            @php
                                $laba = $post->pkb_final - $expense;
                            @endphp
                        @else
                            @php
                                $laba = $post->pkb_awal - $expense;
                            @endphp
                        @endif
                        <td class="{{ $laba > 0 ? 'text-success' : 'text-danger' }} no-wrap">
                            <b>{{ formatRupiah($laba) }}</b>
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
                'print', 'excel'
            ],
            "pageLength": 10,
            "order": [0, 'desc'],
        });
    </script>
@endsection
