<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mx-3">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pekerjaan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">
                <form method="POST" action="/icon/proyek" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="project_id" class="form-label">ID Proyek</label>
                        <input type="text" class="form-control @error('project_id') is-invalid @enderror"
                            name="project_id" id="project_id" required value="{{ old('project_id') }}">
                        @error('project_id')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Nama Pekerjaan</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" required value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Wilayah Kerja</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                            name="location" id="location" required value="{{ old('location') }}">
                        @error('location')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
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
                        <label for="no_pa" class="form-label">Nomor PA</label>
                        <input type="text" class="form-control @error('no_pa') is-invalid @enderror" id="no_pa"
                            name="no_pa" required value="{{ old('no_pa') }}">
                        @error('no_pa')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pkb_initial" class="form-label">PKB Awal</label>
                        <input type="number" class="form-control @error('pkb_initial') is-invalid @enderror"
                            id="pkb_initial" name="pkb_initial" value="{{ old('pkb_initial') }}">
                        @error('pkb_initial')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pkb_final" class="form-label">PKB Akhir</label>
                        <input type="number" class="form-control @error('pkb_final') is-invalid @enderror"
                            id="pkb_final" name="pkb_final" value="{{ old('pkb_final') }}">
                        @error('pkb_final')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Pekerjaan</label>
                        <select type="text" class="form-select" id="status" name="status">
                            <option value="OPEN" {{ old('status') == 'OPEN' ? 'selected' : '' }}
                                class="text-success"><b>OPEN</b></option>
                            <option value="CLOSED" {{ old('status') == 'CLOSED' ? 'selected' : '' }}
                                class="text-danger"><b>CLOSED</b></option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="note" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="note" name="note"
                            value="{{ old('note') }}">
                    </div>

                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary mb-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
