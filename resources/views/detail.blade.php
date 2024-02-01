@extends('layouts.main')

@section('body')
    <h1 class="mb-4">Detail Proyek</h1>
    <table class="table table-hover table-striped-columns table-bordered">
        <tr>
            <td>Nama Pekerjaan</td>
            <td><a href="/pengeluaran?project={{ $project->slug }}" class="text-decoration-none">{{ $project->title }}</a>
            </td>
        </tr>
        <tr>
            <td>Tanggal Input</td>
            <td>{{ $project->project_date }}</td>
        </tr>
        <tr>
            <td>Area Kerja</td>
            <td>{{ $project->location_id }}</td>
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
            <td>{{ formatRupiah($project->comcast) }}</td>
        </tr>
        <tr>
            <td>Nilai BOQ Minus Comcast</td>
            <td>
                @if ($project->boq_actual === null || $project->boq_actual < 1)
                    {{ formatRupiah($project->boq_plan - $project->comcase) }}
                @else
                    {{ formatRupiah($project->boq_actual - $project->comcast) }}
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
    <a href="/proyek">Kembali</a>
@endsection
