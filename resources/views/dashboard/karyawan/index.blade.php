@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Karyawan</h1>
        <div class="">
            <a href="/dashboard/karyawanNonaktif" class="btn btn-secondary">Daftar Karyawan Nonaktif</a>
            <a href="/dashboard/karyawan/create" class="btn btn-primary">Tambah Karyawan Baru</a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('failed'))
        <div class="alert alert-danger col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table table-responsive table-sm small mt-3 mb-4">
        <table class="table table-striped align-middle table-hover">
            <thead>
                <tr class="align-middle">
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Tanggal Mulai Kerja</th>
                    <th scope="col">Lokasi Kerja</th>
                    <th scope="col">Bagian</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employee as $post)
                    <tr>
                        <td>{{ $post->employee_id }}</td>
                        <td>{{ $post->name }}</td>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->birth_date)->format('d-M-Y') }}</td>
                        <td>{{ $post->phone_number }}</td>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->start_date)->format('d-M-Y') }}</td>
                        <td>{{ $post->work_location }}</td>
                        <td>{{ $post->department }}</td>
                        <td>{{ $post->position->title }}</td>
                        <td class="no-wrap">
                            <a href="/dashboard/karyawan/{{ $post->id }}" class="btn btn-success btn-sm">
                                <i class="bi bi-eye"></i>
                            </a> <a href="/dashboard/karyawan/{{ $post->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i></a>
                            </a> <a href="/dashboard/karyawan/{{ $post->id }}/editStatus" class="btn btn-dark btn-sm">
                                <i class="bi bi-gear"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
