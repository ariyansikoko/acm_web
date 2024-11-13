@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Proyek</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/proyek/{{ $project->project_id }}" class="mb-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="project_id" class="form-label">ID Proyek</label>
                <input type="text" class="form-control" @error('project_id') is-invalid @enderror id="project_id"
                    name="project_id" required value="{{ old('project_id', $project->project_id) }}" autofocus>
                @error('project_id')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client" class="form-label">Klien</label>
                <select type="text" class="form-select" id="client" name="client">
                    <option value="TA" {{ $project->client == 'TA' ? 'selected' : '' }}>TA</option>
                    <option value="TBG" {{ $project->client == 'TBG' ? 'selected' : '' }}>TBG</option>
                    <option value="TIS" {{ $project->client == 'TIS' ? 'selected' : '' }}>TIS</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="project_date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="project_date" name="project_date"
                    value="{{ old('project_date', $project->project_date) }}">
                @error('project_date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="episode" class="form-label">Episode</label>
                <input type="text" class="form-control" @error('episode') is-invalid @enderror id="episode"
                    name="episode" required value="{{ old('episode', $project->episode) }}">
                @error('episode')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="project_area" class="form-label">Area Kerja</label>
                <input type="text" class="form-control" @error('project_area') is-invalid @enderror id="project_area"
                    name="project_area" required value="{{ old('project_area', $project->project_area) }}">
                @error('project_area')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="project_location" class="form-label">Lokasi Proyek</label>
                <input type="text" class="form-control" @error('project_location') is-invalid @enderror id="project_location"
                    name="project_location" value="{{ old('project_location', $project->project_location) }}">
                @error('project_location')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Jenis Proyek</label>
                <select type="text" class="form-select" id="type" name="type">
                    <option value="HEM" {{ $project->type == 'HEM' ? 'selected' : '' }}>HEM</option>
                    <option value="MATR" {{ $project->type == 'MATR' ? 'selected' : '' }}>MATR</option>
                    <option value="MTEL" {{ $project->type == 'MTEL' ? 'selected' : '' }}>MTEL</option>
                    <option value="NODE B" {{ $project->type == 'NODE B' ? 'selected' : '' }}>NODE B</option>
                    <option value="PT2NS" {{ $project->type == 'PT2NS' ? 'selected' : '' }}>PT2NS</option>
                    <option value="PSB" {{ $project->type == 'PSB' ? 'selected' : '' }}>PSB</option>
                    <option value="QE" {{ $project->type == 'QE' ? 'selected' : '' }}>QE</option>
                    <option value="STTF" {{ $project->type == 'STTF' ? 'selected' : '' }}>STTF</option>
                    <option value="TBG" {{ $project->type == 'TBG' ? 'selected' : '' }}>TBG</option>
                    <option value="GAMAS" {{ $project->type == 'GAMAS' ? 'selected' : '' }}>GAMAS</option>
                    <option value="MAINT" {{ $project->type == 'MAINT' ? 'selected' : '' }}>MAINT</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Nama Pekerjaan</label>
                <input type="text" class="form-control" @error('title') is-invalid @enderror id="title"
                    name="title" required value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_plan" class="form-label">Nilai BOQ Plan</label>
                <input type="text" class="form-control" @error('boq_plan') is-invalid @enderror id="boq_plan"
                    name="boq_plan" required value="{{ old('boq_plan', $project->boq_plan) }}">
                @error('boq_plan')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_actual" class="form-label">Nilai BOQ Aktual</label>
                <input type="text" class="form-control" @error('boq_actual') is-invalid @enderror id="boq_actual"
                    name="boq_actual" value="{{ old('boq_actual', $project->boq_actual) }}">
                @error('boq_actual')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="comcase" class="form-label">Nilai Comcase</label>
                <input type="text" class="form-control" @error('comcase') is-invalid @enderror id="comcase"
                    name="comcase" value="{{ old('comcase', $project->comcase) }}">
                @error('comcase')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_subcon" class="form-label">Nilai BOQ Subcon</label>
                <input type="text" class="form-control" @error('boq_subcon') is-invalid @enderror id="boq_subcon"
                    name="boq_subcon" value="{{ old('boq_subcon', $project->boq_subcon) }}">
                @error('boq_subcon')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_desc" class="form-label">Keterangan BOQ</label>
                <select type="text" class="form-select" id="boq_desc" name="boq_desc"
                    value="{{ old('boq_desc', $project->boq_desc) }}">
                    @if (old('boq_desc', $project->boq_desc) == 'Sudah nilai rekon')
                        <option value="Sudah nilai rekon" selected>Sudah nilai rekon</option>
                        <option value="Belum fix nilai rekon">Belum fix nilai rekon</option>
                    @else
                        <option value="Sudah nilai rekon">Sudah nilai rekon</option>
                        <option value="Belum fix nilai rekon" selected>Belum fix nilai rekon</option>
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label for="no_po" class="form-label">Nomor PO</label>
                <input type="text" class="form-control" @error('no_po') is-invalid @enderror id="no_po"
                    name="no_po" value="{{ old('no_po', $project->no_po) }}">
                @error('no_po')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status Budget Proyek</label>
                <select class="form-select" name="status">
                    @if (old('status', $project->status) == 1)
                        <option value="1" selected>Open</option>
                        <option value="0">Closed</option>
                    @else
                        @can('admin')
                            <option value="1">Open</option>
                        @endcan
                        <option value="0" selected>Closed</option>
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Catatan Khusus Proyek</label>
                <input type="text" class="form-control" @error('note') is-invalid @enderror id="note"
                    name="note" value="{{ old('note', $project->note) }}"></input>
                @error('note')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="close_date" class="form-label">Tanggal Tutup Budget</label>
                <input type="date" class="form-control" id="close_date" name="close_date"
                    value="{{ old('close_date', $project->close_date) }}">
                @error('close_date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
