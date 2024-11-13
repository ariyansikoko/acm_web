@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Laporan Laba/Rugi</h2>
        <div class="">
            <a href="/proyek/{{ $project->project_id }}/export" target="_blank" class="btn btn-info">Export PDF</a>
            <button type="button" class="btn btn-primary" id="modalOpen" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Transaksi</a>
            </button>
        </div>
    </div>

    <div class="justify-content-center">
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
    </div>

    <h3 class="my-4 text-center">{{ $header }}</h3>

    <div class="text-center mb-3">

    </div>

    @include('partials.addTransaction')
    <div class="col-md-6 mx-auto">
        <table class="table table-hover table-bordered table-striped-columns table-sm small">
            <tr class="table-dark">
                <th>Investasi Episode</th>
                <th>{{ $episode }}</th>
            </tr>
            <tr class="table-secondary">
                <th>Total Nilai BOQ ALL</th>
                <td>{{ formatRupiah($projectall->sum('boq_plan')) }}</td>
            </tr>
            <tr class="table-secondary">
                <th>Total Pengeluaran ALL</th>
                <td>{{ formatRupiah($totalamount) }}</td>
            </tr>
            <tr class="table-secondary">
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
                <th>Persentase Sisa Pengambilan</th>
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
                    $laba = $project->boq_actual - $totalbp - $totaldp + $project->comcase;
                    $persentase = $laba / ($project->boq_actual + $project->comcase) * 100;
                @endphp
            @else
                @php
                    $laba = $project->boq_plan - $totalbp - $totaldp + $project->comcase;
                    $persentase = $laba / ($project->boq_plan + $project->comcase) * 100;
                @endphp
            @endif
            <tr class="{{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                <th>Laba/Rugi Sementara</th>
                <td>{{ formatRupiah($laba) }}</td>
            </tr>
            <tr class="{{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                <th>Persentase Laba/Rugi</th>
                <td>{{ formatPercent($persentase) }}</td>
            </tr>
            @if ($project['note'] != null)
            <tr>
                <td colspan="2"><b>Catatan Khusus:<br>
                </b>{{ $project['note'] }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="col-md-8 mx-auto">
        <table class="table table-hover table-striped-columns table-bordered table-sm small">
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
                            <td>
                                {{ formatRupiah($transaction->where('expensetype_id', $item->id)->where('category', 'Biaya Perusahaan')->sum('amount')) }}
                            </td>
                            <td>
                                {{ formatRupiah($transaction->where('expensetype_id', $item->id)->where('category', 'DP Subcon')->sum('amount')) }}
                            </td>
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
    <a class="btn btn-primary mb-4" href="/proyek">Kembali</a>

    <script>
        $("#modalOpen").on("click", function() {
            // Open the modal
            $('#exampleModal').modal('show');
        });
    </script>
@endsection
