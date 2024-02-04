@extends('dashboard.layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Penerima Baru</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/penerima " class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Penerima</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" id="slug" name="slug" disabled>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/dashboard/penerima/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection
