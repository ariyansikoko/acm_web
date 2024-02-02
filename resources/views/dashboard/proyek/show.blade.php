@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Proyek</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-hover table-striped-columns table-bordered">
        <tr>
            <td>Nama Pekerjaan</td>
            <td>{{ $project->title }}</td>
        </tr>
        <tr>
            <td>Tanggal Input</td>
            <td>{{ $project->project_date }}</td>
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
            <td>Nilai BOQ Minus Comcast</td>
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
@endsection
