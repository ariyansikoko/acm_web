@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Proyek</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-3">
        <a href="/dashboard/proyek" class="btn btn-primary">
            <i class="bi bi-caret-left-fill"></i> Kembali
        </a> <a href="/dashboard/proyek/{{ $project->project_id }}/edit" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit</a>
        <form action="/dashboard/proyek/{{ $project->project_id }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
    </div>

    <div class="col-md-8">
        <table class="table table-hover table-striped-columns table-bordered">
            <tr>
                <td>Status Budget Proyek</td>
                @if ($project->status == 1)
                    <td class="text-success"><b> OPEN </b></td>
                @else
                    <td><b class="text-danger"> CLOSED</b> (
                        {{ \Carbon\Carbon::parse($project->close_date)->format('D d M Y') }})</td>
                @endif
            </tr>
            <tr>
                <td>Episode</td>
                <td>{{ $project->episode }}</td>
            </tr>
            <tr>
                <td>Nama Pekerjaan</td>
                <td><b>{{ $project->project_id }} - {{ $project->title }}</b></td>
            </tr>
            <tr>
                <td>Tanggal Input</td>
                <td>{{ \Carbon\Carbon::parse($project->project_date)->format('D, d M Y') }}</td>
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
                        {{ formatRupiah($project->boq_plan - $project->comcase) }}
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
            <tr>
                <td>Nomor PO</td>
                <td>{{ $project->no_po }}</td>
            </tr>
        </table>
    </div>
@endsection
