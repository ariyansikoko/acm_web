@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Proyek Baru</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/proyek" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="project_id" class="form-label">ID Proyek</label>
                <input type="text" class="form-control" @error('project_id') is-invalid @enderror id="project_id"
                    name="project_id" required value="{{ old('project_id') }}" autofocus>
                @error('project_id')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client" class="form-label">Klien</label>
                <input type="text" class="form-control" id="client" name="client" required value="TA">
            </div>
            <div class="mb-3">
                <label for="project_date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="project_date" name="project_date"
                    value="{{ old('project_date') }}">
                @error('project_date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="episode" class="form-label">Episode</label>
                <input type="number" class="form-control" @error('episode') is-invalid @enderror id="episode"
                    name="episode" required value="{{ old('episode') }}">
                @error('episode')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Area Kerja</label>
                <input type="text" class="form-control" @error('location') is-invalid @enderror id="location"
                    name="location" required value="{{ old('location') }}">
                @error('location')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Jenis Proyek</label>
                <select type="text" class="form-select" id="type" name="type">
                    <option value="HEM" {{ old('type') == 'HEM' ? 'selected' : '' }}>HEM</option>
                    <option value="MATR" {{ old('type') == 'MATR' ? 'selected' : '' }}>MATR</option>
                    <option value="MTEL" {{ old('type') == 'MTEL' ? 'selected' : '' }}>MTEL</option>
                    <option value="NODE B" {{ old('type') == 'NODE B' ? 'selected' : '' }}>NODE B</option>
                    <option value="PT2NS" {{ old('type') == 'PT2NS' ? 'selected' : '' }}>PT2NS</option>
                    <option value="PSB" {{ old('type') == 'PSB' ? 'selected' : '' }}>PSB</option>
                    <option value="QE" {{ old('type') == 'QE' ? 'selected' : '' }}>QE</option>
                    <option value="STTF" {{ old('type') == 'STTF' ? 'selected' : '' }}>STTF</option>
                    <option value="TBG" {{ old('type') == 'TBG' ? 'selected' : '' }}>TBG</option>
                    <option value="GAMAS" {{ old('type') == 'GAMAS' ? 'selected' : '' }}>GAMAS</option>
                    <option value="MAINT" {{ old('type') == 'MAINT' ? 'selected' : '' }}>MAINT</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Nama Pekerjaan</label>
                <input type="text" class="form-control" @error('title') is-invalid @enderror id="title"
                    name="title" required value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_plan" class="form-label">Nilai BOQ Plan</label>
                <input type="number" class="form-control" @error('boq_plan') is-invalid @enderror id="boq_plan"
                    name="boq_plan" required value="{{ old('boq_plan') }}">
                @error('boq_plan')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_actual" class="form-label">Nilai BOQ Aktual</label>
                <input type="number" class="form-control" @error('boq_actual') is-invalid @enderror id="boq_actual"
                    name="boq_actual" value="{{ old('boq_actual') }}">
                @error('boq_actual')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="comcase" class="form-label">Nilai Comcase</label>
                <input type="number" class="form-control" @error('comcase') is-invalid @enderror id="comcase"
                    name="comcase" value="{{ old('comcase') }}">
                @error('comcase')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_subcon" class="form-label">Nilai BOQ Subcon</label>
                <input type="number" class="form-control" @error('boq_subcon') is-invalid @enderror id="boq_subcon"
                    name="boq_subcon" value="{{ old('boq_subcon') }}">
                @error('boq_subcon')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="boq_desc" class="form-label">Keterangan BOQ</label>
                <select type="text" class="form-select" id="boq_desc" name="boq_desc"
                    value="{{ old('boq_desc') }}">
                    <option value="Sudah nilai rekon">Sudah nilai rekon</option>
                    <option value="Belum fix nilai rekon" selected>Belum fix nilai rekon</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_po" class="form-label">Nomor PO</label>
                <input type="text" class="form-control" @error('no_po') is-invalid @enderror id="no_po"
                    name="no_po" value="{{ old('no_po') }}">
                @error('no_po')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
