@extends('layouts.main')

@section('body')
    <h1 class="text-center">Laporan Laba/Rugi</h1>
    <h3 class="my-4 text-center">{{ $header }}</h3>
    <div class="col-md-6 mx-auto">
        <table class="table table-hover table-striped table-bordered small py-1">
            <tr class="table-success">
                <th>Investasi Episode</th>
                <th>{{ $episode }}</th>
            </tr>
            <tr class="table-success">
                <th>Total Nilai BOQ ALL</th>
                <td>{{ formatRupiah($projectall->sum('boq_plan')) }}</td>
            </tr>
            <tr class="table-success">
                <th>Total Pengeluaran ALL</th>
                <td>{{ formatRupiah($totalamount) }}</td>
            </tr>
            <tr class="table-success">
                <th>Persentase ALL</th>
                <td>{{ formatPercent(($totalamount / $projectall->sum('boq_plan')) * 100) }}</td>
            </tr>
            <tr class="table-warning">
                <th>Nilai BOQ Plan</th>
                <td>{{ formatRupiah($project->boq_plan) }}</td>
            </tr>
            <tr class="table-warning">
                <th>Nilai BOQ Aktual</th>
                <td>{{ formatRupiah($project->boq_actual) }}</td>
            </tr>
            <tr class="table-warning">
                <th>Nilai Comcase</th>
                <td>{{ formatRupiah($project->comcase) }}</td>
            </tr>
            <tr class="table-warning">
                <th>Nilai BOQ Subcon</th>
                <td>{{ formatRupiah($project->boq_subcon) }}</td>
            </tr>
            <tr class="table-info">
                <th>Total Pengambilan (DP Subcon)</th>
                <td>{{ formatRupiah($totaldp) }}</td>
            </tr>
            <tr class="table-info">
                <th>Sisa Pengambilan</th>
                <td>{{ formatRupiah($project->boq_subcon - $totaldp) }}</td>
            </tr>
            <tr class="table-info">
                <th>Persentase Pengambilan</th>
                <td>
                    @if ($project->boq_subcon)
                        {{ formatPercent((($project->boq_subcon - $totaldp) / $project->boq_subcon) * 100) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr class="table-info">
                <th>Persentase Pengambilan dari BOQ</th>
                <td>
                    @if ($project->boq_actual != 0)
                        {{ formatPercent(($totaldp / $project->boq_actual) * 100) }}
                    @else
                        {{ formatPercent(($totaldp / $project->boq_plan) * 100) }}
                    @endif
                </td>
            </tr>
            <tr class="table-info">
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
                @endphp
            @else
                @php
                    $laba = $project->boq_plan - $totalbp - $totaldp;
                @endphp
            @endif
            <tr class="{{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                <th>Laba/Rugi Sementara</th>
                <td>{{ formatRupiah($laba) }}</td>
            </tr>

        </table>
    </div>
    <div class="col-md-8 mx-auto">
        <table class="table table-hover table-striped table-bordered small">
            <thead>
                <tr>
                    <th scope="col"></th>
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
                                <td>0</td>
                                <td>
                                    {{ formatRupiah($transaction->where('expensetype_id', $item->id)->sum('amount')) }}
                                </td>
                            @else
                                <td>
                                    {{ formatRupiah($transaction->where('expensetype_id', $item->id)->sum('amount')) }}
                                </td>
                                <td>0</td>
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
    <a class="btn btn-primary" href="/proyek">Kembali</a>
@endsection
