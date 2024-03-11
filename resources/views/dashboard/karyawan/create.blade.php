@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Karyawan Baru</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/karyawan" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="employee_id" class="form-label">ID Karyawan</label>
                <input type="text" class="form-control" @error('employee_id') is-invalid @enderror id="employee_id"
                    name="employee_id" required value="{{ old('employee_id') }}" autofocus>
                @error('employee_id')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required
                    @error('name') is-invalid @enderror value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date"
                    value="{{ old('birth_date') }}">
                @error('birth_date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Sekarang</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                @error('address')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">No HP</label>
                <input type="text" class="form-control" @error('phone_number') is-invalid @enderror id="phone_number"
                    name="phone_number" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai Kerja</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="work_location" class="form-label">Lokasi Kerja</label>
                <select type="text" class="form-select" id="work_location" name="work_location">
                    <option value="Bengkulu" {{ old('work_location') == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                    <option value="Jambi" {{ old('work_location') == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                    <option value="Lampung" {{ old('work_location') == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                    <option value="Medan" {{ old('work_location') == 'Medan' ? 'selected' : '' }}>Medan</option>
                    <option value="Pekanbaru" {{ old('work_location') == 'Pekanbaru' ? 'selected' : '' }}>Pekanbaru
                    </option>
                    <option value="RIDAR" {{ old('work_location') == 'RIDAR' ? 'selected' : '' }}>RIDAR</option>
                    <option value="RIKEP" {{ old('work_location') == 'RIKEP' ? 'selected' : '' }}>RIKEP</option>
                    <option value="SUMBAR" {{ old('work_location') == 'SUMBAR' ? 'selected' : '' }}>SUMBAR</option>
                    <option value="SUMUT" {{ old('work_location') == 'SUMUT' ? 'selected' : '' }}>SUMUT</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Bagian</label>
                <select type="text" class="form-select" id="department" name="department">
                    <option value="Accounting" {{ old('department') == 'Accounting' ? 'selected' : '' }}>Accounting
                    </option>
                    <option value="Administrasi" {{ old('department') == 'Administrasi' ? 'selected' : '' }}>
                        Administrasi</option>
                    <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="HRD" {{ old('department') == 'HRD' ? 'selected' : '' }}>HRD</option>
                    <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Project" {{ old('department') == 'Project' ? 'selected' : '' }}>Project</option>
                    <option value="Provisioning" {{ old('department') == 'Provisioning' ? 'selected' : '' }}>Provisioning
                    </option>
                    <option value="Sales" {{ old('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="position_id" class="form-label">Jabatan</label>
                <select type="text" class="form-select" id="position_id" name="position_id">
                    @foreach ($positions as $item)
                        @if (old('position_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->code . ' - ' . $item->title }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->code . ' - ' . $item->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Gaji</label>
                <input type="number" class="form-control" @error('salary') is-invalid @enderror id="salary"
                    name="salary" value="{{ old('salary') }}">
                @error('salary')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bank_name" class="form-label">Nama Bank</label>
                <input type="text" class="form-control" id="bank_name" name="bank_name"
                    value="{{ old('bank_name') }}">
                @error('bank_name')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="account_number" class="form-label">No Rekening</label>
                <input type="text" class="form-control" id="account_number" name="account_number"
                    value="{{ old('account_number') }}">
                @error('account_number')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ktp_number" class="form-label">No KTP</label>
                <input type="text" class="form-control" id="ktp_number" name="ktp_number"
                    value="{{ old('ktp_number') }}">
                @error('ktp_number')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bpjs" class="form-label">No BPJS</label>
                <input type="text" class="form-control" id="bpjs" name="bpjs" value="{{ old('bpjs') }}">
                @error('bpjs')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="npwp" class="form-label">NPWP</label>
                <input type="text" class="form-control" id="npwp" name="npwp" value="{{ old('npwp') }}">
                @error('npwp')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ptkp_status" class="form-label">Status PTKP</label>
                <select type="text" class="form-select" id="ptkp_status" name="ptkp_status">
                    <option value="K0" {{ old('ptkp_status') == 'K0' ? 'selected' : '' }}>K0</option>
                    <option value="K1" {{ old('ptkp_status') == 'K1' ? 'selected' : '' }}>K1</option>
                    <option value="K2" {{ old('ptkp_status') == 'K2' ? 'selected' : '' }}>K2</option>
                    <option value="K3" {{ old('ptkp_status') == 'K3' ? 'selected' : '' }}>K3</option>
                    <option value="TK0" {{ old('ptkp_status') == 'TK0' ? 'selected' : '' }}>TK0</option>
                    <option value="TK1" {{ old('ptkp_status') == 'TK1' ? 'selected' : '' }}>TK1</option>
                    <option value="TK2" {{ old('ptkp_status') == 'TK2' ? 'selected' : '' }}>TK2</option>
                    <option value="TK3" {{ old('ptkp_status') == 'TK3' ? 'selected' : '' }}>TK3</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="blood_type" class="form-label">Golongan Darah</label>
                <select type="text" class="form-select" id="blood_type" name="blood_type">
                    <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="emergency_contact" class="form-label">Nama Kontak Emergency</label>
                <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                    value="{{ old('emergency_contact') }}">
                @error('emergency_contact')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="emergency_number" class="form-label">Nomor Kontak Emergency</label>
                <input type="text" class="form-control" id="emergency_number" name="emergency_number"
                    value="{{ old('emergency_number') }}">
                @error('emergency_number')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image_self" class="form-label">Pas Foto (Max: 1MB)</label>
                <img class="img-preview-pasfoto img-fluid mb-3 col-sm-3">
                <input class="form-control" @error('image_self') is-invalid @enderror type="file" id="image_self"
                    name="image_self" onchange="previewImagePasfoto()">
                @error('image_self')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image_ktp" class="form-label">Foto KTP (max: 1MB)</label>
                <img class="img-preview-ktp img-fluid mb-3 col-sm-3">
                <input class="form-control" @error('image_ktp') is-invalid @enderror type="file" id="image_ktp"
                    name="image_ktp" onchange="previewImageKTP()">
                @error('image_ktp')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script>
        function previewImagePasfoto() {
            const imagePasfoto = document.querySelector('#image_self');
            const imgPreviewPasfoto = document.querySelector('.img-preview-pasfoto');

            imgPreviewPasfoto.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imagePasfoto.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreviewPasfoto.src = oFREvent.target.result;
            }
        }

        function previewImageKTP() {
            const imageKTP = document.querySelector('#image_ktp');
            const imgPreviewKTP = document.querySelector('.img-preview-ktp');

            imgPreviewKTP.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageKTP.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreviewKTP.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
