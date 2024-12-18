@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Detail Karyawan</h2>
        <a href="/dashboard/karyawan/{{ $employee->id }}/export" target="_blank" class="btn btn-info">Export PDF</a>
    </div>
    <div class="mb-3">
        <a href="/dashboard/karyawan" class="btn btn-primary">
            <i class="bi bi-caret-left-fill"></i> Kembali</a>
        <a href="/dashboard/karyawan/{{ $employee->id }}/edit" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit</a>
        @if ($employee->quit_status != 'Aktif')
            <form action="/dashboard/karyawan/{{ $employee->id }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        @else
            <a href="/dashboard/karyawan/{{ $employee->id }}/editStatus" class="btn btn-secondary">
                <i class="bi bi-gear"></i> Edit Status</a>
        @endif
    </div>
    <div class="col-md-7">
        <table class="table table-sm small">
            <tr class="align-bottom">
                <td class="text-end">
                    @if ($employee->image_self)
                        <img src="{{ asset('storage/' . $employee->image_self) }}" alt="{{ $employee->name }}"
                            style="max-height: 150px; width: auto">
                    @else
                        <img src="/images/placeholderpasfoto.png" alt="{{ $employee->name }}"
                            style="max-height: 150px; width: auto">
                    @endif
                </td>
                <td>
                    @if ($employee->image_ktp)
                        <img src="{{ asset('storage/' . $employee->image_ktp) }}" alt="{{ $employee->name }}"
                            style="max-height: 150px; width: auto">
                    @else
                        <img src="/images/placeholderktp.jpg" alt="{{ $employee->name }}"
                            style="max-height: 150px; width: auto">
                    @endif
                </td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                @if ($employee->quit_status == 'Aktif')
                    <td class="text-success"><b>Aktif</b></td>
                @else
                    <td><b class="text-danger">Berhenti</b>,
                        {{ \Carbon\Carbon::parse($employee->quit_date)->format('d M Y') }}</td>
                @endif

            </tr>
            <tr>
                <th scope="row">Nama</th>
                <td>{{ $employee->name }}</td>
            </tr>
            <tr>
                <th scope="row">Tanggal Lahir</th>
                <td>{{ \Carbon\Carbon::parse($employee->birth_date)->format('d M Y') }}</td>
            </tr>
            <tr>
                <th scope="row">Alamat Sekarang</th>
                <td>{{ $employee->address }}</td>
            </tr>
            <tr>
                <th scope="row">No HP</th>
                <td>{{ $employee->phone_number }}</td>
            </tr>
            <tr>
                <th scope="row">Tanggal Mulai Kerja</th>
                <td>{{ \Carbon\Carbon::parse($employee->start_date)->format('d M Y') }}</td>
            </tr>
            <tr>
                <th scope="row">Lokasi Kerja</th>
                <td>{{ $employee->work_location }}</td>
            </tr>
            <tr>
                <th scope="row">Bagian</th>
                <td>{{ $employee->department }}</td>
            </tr>
            <tr>
                <th scope="row">Jabatan</th>
                <td>{{ $employee->position->title }}</td>
            </tr>
            <tr>
                <th scope="row">Gaji</th>
                <td>{{ formatRupiah($employee->salary) }}</td>
            </tr>
            <tr>
                <th scope="row">Nama Bank</th>
                <td>{{ $employee->bank_name }}</td>
            </tr>
            <tr>
                <th scope="row">No Rekening</th>
                <td>{{ $employee->account_number }}</td>
            </tr>
            <tr>
                <th scope="row">No KTP</th>
                <td>{{ $employee->ktp_number }}</td>
            </tr>
            <tr>
                <th scope="row">No BPJS</th>
                <td>{{ $employee->bpjs }}</td>
            </tr>
            <tr>
                <th scope="row">NPWP</th>
                <td>{{ $employee->npwp }}</td>
            </tr>
            <tr>
                <th scope="row">Status PTKP</th>
                <td>{{ $employee->ptkp_status }}</td>
            </tr>
            <tr>
                <th scope="row">Golongan Darah</th>
                <td>{{ $employee->blood_type }}</td>
            </tr>
            <tr>
                <th scope="row">Emergency Contact</th>
                <td>{{ $employee->emergency_contact . ' - ' . $employee->emergency_number }}</td>
            </tr>
        </table>
    </div>
@endsection
