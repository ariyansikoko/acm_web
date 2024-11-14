@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Edit Detail Pekerjaan</h2>
        <div class="">
        </div>
    </div>

    <div class="col-lg-6 mx-auto mb-5">
        <form method="POST" action="/icon/proyek/{{ $project->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Nama Pekerjaan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Wilayah Kerja</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" name="location"
                    id="location" required value="{{ old('location', $project->location) }}">
                @error('location')
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
                <label for="no_pa" class="form-label">Nomor PA</label>
                <input type="text" class="form-control @error('no_pa') is-invalid @enderror" id="no_pa"
                    name="no_pa" required value="{{ old('no_pa', $project->no_pa) }}">
                @error('no_pa')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pkb_initial" class="form-label">PKB Awal</label>
                <input type="text" class="form-control @error('pkb_initial') is-invalid @enderror" id="pkb_initial"
                    name="pkb_initial" value="{{ old('pkb_initial', $project->pkb_initial) }}">
                @error('pkb_initial')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pkb_final" class="form-label">PKB Akhir</label>
                <input type="text" class="form-control @error('pkb_final') is-invalid @enderror" id="pkb_final"
                    name="pkb_final" value="{{ old('pkb_final', $project->pkb_final) }}">
                @error('pkb_final')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="note" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="note" name="note"
                    value="{{ old('note', $project->note) }}">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
