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
                <label for="location" class="form-label">Area Kerja</label>
                <input type="text" class="form-control" @error('location') is-invalid @enderror id="location"
                    name="location" required value="{{ old('location', $project->location) }}">
                @error('location')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Jenis Proyek</label>
                <input type="text" class="form-control" @error('type') is-invalid @enderror id="type" name="type"
                    required value="{{ old('type', $project->type) }}">
                @error('type')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
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
                <input type="text" class="form-control" id="boq_desc" name="boq_desc"
                    value="{{ old('boq_desc', $project->boq_desc) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
