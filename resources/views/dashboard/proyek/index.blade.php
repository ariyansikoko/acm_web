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

    <div class="table-responsive small">
        <a href="/dashboard/proyek/create" class="btn btn-primary mb-3">Tambah Proyek Baru</a>
        <table class="table table-striped table-sm align-middle table-hover">
            <thead>
                <tr class="align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">EP</th>
                    <th scope="col">Area<br>Kerja</th>
                    <th scope="col">Jenis<br>Proyek</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">BOQ Plan</th>
                    <th scope="col">BOQ Aktual</th>
                    <th scope="col">Comcase</th>
                    <th scope="col">BOQ-Comcase</th>
                    <th scope="col">BOQ Subcon</th>
                    <th scope="col">Keterangan BOQ</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td>{{ $post->episode }}</td>
                        <td>{{ $post->location }}</td>
                        <td>{{ $post->type }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ formatRupiah($post->boq_plan) }}</td>
                        <td>{{ formatRupiah($post->boq_actual) }}</td>
                        <td>{{ formatRupiah($post->comcase) }}</td>
                        <td>
                            @if ($post->boq_actual != 0)
                                {{ formatRupiah($post->boq_actual - $post->comcase) }}
                            @else
                                {{ formatRupiah($post->boq_plan - $post->comcase) }}
                            @endif
                        </td>
                        <td>{{ formatRupiah($post->boq_subcon) }}</td>
                        <td>{{ $post->boq_desc }}</td>
                        <td>
                            <a href="/dashboard/proyek/{{ $post->project_id }}" class="btn btn-success btn-sm">
                                <i class="bi bi-eye"></i>
                            </a> <a href="/dashboard/proyek/{{ $post->project_id }}/edit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/proyek/{{ $post->project_id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
