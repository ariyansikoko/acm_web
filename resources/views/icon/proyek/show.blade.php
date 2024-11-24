@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Detail Pekerjaan</h2>
        <div class="">
            <a href="/icon/proyek/{{ $project->id }}/transaksi/create" class="btn btn-success">
                <i class="bi bi-currency-dollar"></i></a>
            <a href="/icon/proyek/{{ $project->id }}/edit" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i></a>
            <form action="/icon/proyek/{{ $project->id }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah yakin ingin menghapus?')">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
            <a href="/icon/proyek/" class="btn btn-info">
                Kembali</a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show mx-auto" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('failed'))
        <div class="alert alert-danger col-lg-8 alert-dismissible fade show mx-auto" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-4 small" id="scrollX">
        <div class="col-md-8 mx-auto">
            <table class="table table-hover table-striped-columns table-bordered border-dark">
                <tr>
                    <td><b>ID PROYEK</b></td>
                    <td>{{ $project->project_id }}</td>
                </tr>
                <tr>
                    <td><b>WILAYAH KERJA</b></td>
                    <td>{{ $project->location }}</td>
                </tr>
                <tr>
                    <td><b>TANGGAL ORDER</b></td>
                    <td class="no-wrap">{{ \Carbon\Carbon::parse($project->project_date)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td><b>NO PA</b></td>
                    <td>{{ $project->no_pa }}</td>
                </tr>
                <tr>
                    <td><b>NAMA PEKERJAAN</b></td>
                    <td>{{ $project->title }}</td>
                </tr>
                <tr>
                    <td><b>PKB AWAL</b></td>
                    <td class="no-wrap">{{ formatRupiah($project->pkb_initial) }}</td>
                </tr>
                <tr>
                    <td><b>PKB AKHIR</b></td>
                    <td class="no-wrap">{{ formatRupiah($project->pkb_final) }}</td>
                </tr>
                <tr>
                    <td><b>TOTAL PENGELUARAN</b></td>
                    <td class="no-wrap">{{ formatRupiah($totalexpense) }}</td>
                </tr>
                @php
                    $laba = $project->pkb_final - $totalexpense;
                @endphp
                <tr>
                    <td><b>LABA/RUGI</b></td>
                    <td class="no-wrap {{ $laba > 0 ? 'table-success' : 'table-danger' }}">{{ formatRupiah($laba) }}</td>
                </tr>
                @if ($project->pkb_final !== 0)
                    <tr>
                        <td><b>PERSENTASE LABA/RUGI</b></td>
                        <td class="no-wrap {{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                            {{ formatPercent(($laba / $project->pkb_final) * 100) }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td><b>PERSENTASE LABA/RUGI</b></td>
                        <td class="no-wrap {{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                            {{ formatPercent(($laba / $project->pkb_awal) * 100) }}
                        </td>
                    </tr>
                @endif
                @if ($project->note !== null)
                    <tr>
                        <td><b>KETERANGAN</b></td>
                        <td class="no-wrap">{{ $project->note }}</td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="col-md-6 mx-auto mb-5">
            <h5 class="text-center">Rincian Pengeluaran</h5>
            <table class="table small table-hover" style="margin: 0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="no-wrap">TANGGAL</th>
                        <th scope="col" class="no-wrap">NO PENGAJUAN</th>
                        <th scope="col">PENERIMA</th>
                        <th scope="col">KATEGORI</th>
                        <th scope="col">JUMLAH</th>
                        <th scope="col" class="no-wrap">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transactions->IsNotEmpty())
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="no-wrap">
                                    @if ($transaction->date)
                                        {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                                    @endif
                                </td>
                                <td>{{ $transaction['no'] }}</td>
                                <td class="no-wrap">{{ $transaction->recipient }}</td>
                                <td class="no-wrap">{{ $transaction->category }}</td>
                                <td class="no-wrap">{{ formatRupiah($transaction['amount']) }}</td>
                                <td class="no-wrap">
                                    <a href="/icon/proyek/{{ $project->id }}/transaksi/{{ $transaction->id }}"
                                        class="btn btn-success btn-sm"
                                        style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                        <i class="bi bi-eye"></i></a>
                                    <a href="/icon/proyek/{{ $project->id }}/transaksi/{{ $transaction->id }}/edit"
                                        class="btn btn-warning btn-sm"
                                        style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                        <i class="bi bi-pencil-square"></i></a>
                                    <form
                                        action="{{ route('icon_transaction.destroy', ['proyek' => $project->id, 'transaksi' => $transaction->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"
                                            onclick="return confirm('Yakin ingin menghapus?')"
                                            style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="3">Tidak ada pengeluaran</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

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
