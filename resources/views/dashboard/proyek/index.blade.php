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
    @if (session()->has('failed'))
        <div class="alert alert-danger col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table table-responsive small" id="scrollX">
        <a href="/dashboard/proyek/create" class="btn btn-primary mb-3">Tambah Proyek Baru</a>
        <table class="table table-striped align-middle table-hover" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Kode</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">EP</th>
                    <th scope="col">Area Kerja</th>
                    <th scope="col">Jenis Proyek</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">BOQ Plan</th>
                    <th scope="col">BOQ Aktual</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td><b>{{ $post->project_id }}</b></td>
                        <td>{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td>{{ $post->episode }}</td>
                        <td>{{ $post->location }}</td>
                        <td>{{ $post->type }}</td>
                        <td><b>{{ $post->title }}</b></td>
                        <td>{{ formatRupiah($post->boq_plan) }}</td>
                        <td class="text-primary">{{ formatRupiah($post->boq_actual) }}</td>
                        <td>{{ $post->boq_desc }}</td>
                        @if ($post->status == 1)
                            <td class="text-success"><b>OPEN</b></td>
                        @else
                            <td class="text-danger"><b>CLOSED</b></td>
                        @endif
                        <td>
                            <a href="/dashboard/proyek/{{ $post->project_id }}" class="btn btn-success btn-sm"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                <i class="bi bi-eye"></i>
                            </a> <a href="/dashboard/proyek/{{ $post->project_id }}/edit" class="btn btn-warning btn-sm"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/proyek/{{ $post->project_id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
