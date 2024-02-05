@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Akun</h1>
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

    <div class="table-responsive small col-md-8">
        <a href="/register" class="btn btn-primary mb-3">Tambah Akun Baru</a>
        <table class="table table-striped table-sm align-middle table-hover">
            <thead>
                <tr class="align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $item)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        @if ($item->isAdmin == 1)
                            <td>Administrator</td>
                        @else
                            <td>User</td>
                        @endif
                        <td>
                            </a> <a href="/dashboard/account/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="/dashboard/account/{{ $item->id }}" method="POST" class="d-inline">
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
