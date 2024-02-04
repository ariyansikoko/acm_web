@extends('layouts.main')

@section('body')
    <h1 class="mb-4 text-center">Detail Proyek</h1>
    <table class="table table-hover table-striped-columns table-bordered">
        <tr>
            <td>Nama Pekerjaan</td>
            <td>{{ $project->title }}</td>
        </tr>
        <tr>
            <td>Tanggal Input</td>
            <td>{{ \Carbon\Carbon::parse($project->project_date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td>Area Kerja</td>
            <td>{{ $project->location }}</td>
        </tr>
        <tr>
            <td>Jenis Proyek</td>
            <td>{{ $project->type }}</td>
        </tr>
        <tr>
            <td>Nilai BOQ Plan</td>
            <td>{{ formatRupiah($project->boq_plan) }}</td>
        </tr>
        <tr>
            <td>Nilai PO (BOQ Aktual)</td>
            <td>{{ formatRupiah($project->boq_actual) }}</td>
        </tr>
        <tr>
            <td>Nilai Comcase</td>
            <td>{{ formatRupiah($project->comcase) }}</td>
        </tr>
        <tr>
            <td>Nilai BOQ Minus Comcase</td>
            <td>
                @if ($project->boq_actual != 0)
                    {{ formatRupiah($project->boq_actual - $project->comcase) }}
                @else
                    {{ formatRupiah($project->boq_plan - $project->comcast) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Nilai BOQ Subcon</td>
            <td>{{ formatRupiah($project->boq_subcon) }}</td>
        </tr>
        <tr>
            <td>Keterangan BOQ</td>
            <td>{{ $project->boq_desc }}</td>
        </tr>
    </table>
    <a class="btn btn-primary" href="/proyek">Kembali</a>
@endsection
