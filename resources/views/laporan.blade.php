@extends('layouts.main')

@section('body')
    <h1 class="text-center mb-4">Laporan Laba/Rugi Perusahaan</h1>
    <div class="col-md-6 mx-auto">
        <table class="table table-hover table-bordered small py-1">
            <tr class="table-primary">
                <th>Total Nilai BOQ ALL</th>
                <td>{{ formatRupiah($total_boq) }}</td>
            </tr>
            <tr class="table-primary">
                <th>Total Pengeluaran ALL</th>
                <td>{{ formatRupiah($total_pengeluaran) }}</td>
            </tr>
            <tr class="table-primary">
                <th>Persentase ALL</th>
                <td>{{ formatPercent(($total_pengeluaran / $total_boq) * 100) }}</td>
            </tr>
            @php
                $laba = $total_boq - $total_pengeluaran;
            @endphp
            <tr class="{{ $laba > 0 ? 'table-success' : 'table-danger' }}">
                <th>Laba/Rugi Sementara</th>
                <td>{{ formatRupiah($laba) }}</td>
            </tr>

        </table>
    </div>
@endsection
