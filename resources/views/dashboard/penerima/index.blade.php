@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Penerima</h1>
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

    <div class="table-responsive table-sm small col-md-5">
        <a href="/dashboard/penerima/create" class="btn btn-primary mb-3">Tambah Penerima Baru</a>
        <table class="table table-striped table-sm align-middle table-hover">
            <thead>
                <tr class="align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipient as $post)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ $post->name }}</td>
                        @if ($post->isActive == 1)
                            <td class="text-success">Aktif</td>
                        @else
                            <td class="text-danger">Berhenti</td>
                        @endif
                        <td>
                            </a> <a href="/dashboard/penerima/{{ $post->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/penerima/{{ $post->id }}" method="POST" class="d-inline">
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
