@extends('layouts.main')

@section('body')
    <h1 class="mb-4 text-center">Daftar Proyek</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/proyek" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($project->count())
        <table class="table table-striped table-hover align-middle mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal Input</th>
                    <th scope="col">Area Kerja</th>
                    <th scope="col">Jenis Proyek</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Nilai BOQ Plan</th>
                    <th scope="col">Keterangan BOQ</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $post['project_date'] }}</td>
                        <td>{{ $post['location_id'] }}</td>
                        <td>{{ $post['type'] }}</td>
                        <a href="/proyek/{{ $post->slug }}">
                            <td>{{ $post['title'] }}</td>
                        </a>
                        <td>{{ formatRupiah($post['boq_plan']) }}</td>
                        <td>{{ $post['boq_desc'] }}</td>
                        <td>
                            <a href="/proyek/{{ $post['slug'] }}" class="btn btn-sm btn-success">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="col mt-5 text-center">
            <h3>No Data Found.</h3>
        </div>
    @endif
@endsection
