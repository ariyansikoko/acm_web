@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Role Akun</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/account/{{ $accounts->id }} " class="mb-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $accounts->name) }}">
                @error('name')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $accounts->email) }}">
                @error('email')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isAdmin" class="form-label">Role</label>
                <select class="form-select" name="isAdmin">
                    @if (old('isAdmin', $accounts->isAdmin) == 1)
                        <option value="1" selected>Administrator</option>
                        <option value="0">User</option>
                    @else
                        <option value="1">Administrator</option>
                        <option value="0" selected>User</option>
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
