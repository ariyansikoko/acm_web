<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .no-wrap {
            white-space: nowrap;
        }

        @media print {

            .print-header,
            .print-table {
                width: 100%;
                page-break-inside: avoid;
                /* Prevent breaking within headers and tables */
            }

            .print-table {
                page-break-after: auto;
                /* Allow the first table to break across pages when necessary */
            }

            .print-table+.print-header {
                page-break-before: auto;
                /* Allow the header after the first table to break across pages */
            }
        }
    </style>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body onload="window.print()">
    <div class="container mt-4">
        <h5 class="my-4 text-center print-header">{{ $header }}</h5>
        <div class="col-md-4 mx-auto">
            <table class="table table-bordered small table-sm border-dark print-table">
                <tr>
                    <th>Investasi Episode</th>
                    <th>{{ $episode }}</th>
                </tr>
                <tr>
                    <th>Total Nilai BOQ ALL</th>
                    <td>{{ formatRupiah($projectall->sum('boq_plan')) }}</td>
                </tr>
                <tr>
                    <th>Total Pengeluaran ALL</th>
                    <td>{{ formatRupiah($totalamount) }}</td>
                </tr>
                <tr>
                    <th>Persentase ALL</th>
                    <td>{{ formatPercent(($totalamount / $projectall->sum('boq_plan')) * 100) }}</td>
                </tr>
                <tr>
                    <th>Nilai BOQ Plan</th>
                    <td>{{ formatRupiah($project->boq_plan) }}</td>
                </tr>
                <tr>
                    <th>Nilai BOQ Aktual</th>
                    <td>{{ formatRupiah($project->boq_actual) }}</td>
                </tr>
                <tr>
                    <th>Nilai Comcase</th>
                    <td>{{ formatRupiah($project->comcase) }}</td>
                </tr>
                <tr>
                    <th>Nilai BOQ Subcon</th>
                    <td>{{ formatRupiah($project->boq_subcon) }}</td>
                </tr>
                <tr>
                    <th>Total Pengambilan (DP Subcon)</th>
                    <td>{{ formatRupiah($totaldp) }}</td>
                </tr>
                <tr>
                    <th>Sisa Pengambilan</th>
                    <td>{{ formatRupiah($project->boq_subcon - $totaldp) }}</td>
                </tr>
                <tr>
                    <th>Persentase Sisa Pengambilan</th>
                    <td>
                        @if ($project->boq_subcon)
                            {{ formatPercent((($project->boq_subcon - $totaldp) / $project->boq_subcon) * 100) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Persentase Pengambilan dari BOQ</th>
                    <td>
                        @if ($project->boq_actual != 0)
                            {{ formatPercent(($totaldp / $project->boq_actual) * 100) }}
                        @else
                            {{ formatPercent(($totaldp / $project->boq_plan) * 100) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Persentase Biaya Perusahaan</th>
                    <td>
                        @if ($project->boq_actual != 0)
                            {{ formatPercent(($totalbp / $project->boq_actual) * 100) }}
                        @else
                            {{ formatPercent(($totalbp / $project->boq_plan) * 100) }}
                        @endif
                    </td>
                </tr>
                @if ($project->boq_actual != 0)
                    @php
                        $laba = $project->boq_actual - $totalbp - $totaldp;
                        $persentase = ($laba / $project->boq_actual) * 100;
                    @endphp
                @else
                    @php
                        $laba = $project->boq_plan - $totalbp - $totaldp;
                        $persentase = ($laba / $project->boq_plan) * 100;
                    @endphp
                @endif
                <tr">
                    <th>Laba/Rugi Sementara</th>
                    <td>{{ formatRupiah($laba) }}</td>
                    </tr>
                    <tr">
                        <th>Persentase Laba/Rugi</th>
                        <td>{{ formatPercent($persentase) }}</td>
                        </tr>
                        {{-- <tr class="{{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                    <th>Laba/Rugi Sementara</th>
                    <td>{{ formatRupiah($laba) }}</td>
                </tr>
                <tr class="{{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                    <th>Persentase Laba/Rugi</th>
                    <td>{{ formatPercent($persentase) }}</td>
                </tr> --}}

            </table>
        </div>
        <div class="col-md-6 mx-auto print-table">
            <h5 class="text-center my-4">Rincian Transaksi</h5>
            <table class="table table-bordered table-sm small border-dark">
                <thead>
                    <tr>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Biaya Perusahaan</th>
                        <th scope="col">DP Subcon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($type as $item)
                        @if ($transaction->where('expensetype_id', $item->id)->sum('amount') != 0)
                            <tr>
                                <td>{{ $item->name }}</td>
                                @if (in_array($item->name, $filter))
                                    <td>Rp 0</td>
                                    <td>
                                        {{ formatRupiah($transaction->where('expensetype_id', $item->id)->sum('amount')) }}
                                    </td>
                                @else
                                    <td>
                                        {{ formatRupiah($transaction->where('expensetype_id', $item->id)->sum('amount')) }}
                                    </td>
                                    <td>Rp 0</td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <th>{{ formatRupiah($totalbp) }}</th>
                        <th>{{ formatRupiah($totaldp) }}</th>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <th colspan="2">{{ formatRupiah($totalbp + $totaldp) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
