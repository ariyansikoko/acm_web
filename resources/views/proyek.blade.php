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
        <div class="table-responsive small">
            <table class="table table-striped table-hover align-middle mt-4 table-sm">
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                            <td>{{ $post['location'] }}</td>
                            <td>{{ $post['type'] }}</td>
                            <a href="/proyek/{{ $post->slug }}">
                                <td>{{ $post['title'] }}</td>
                            </a>
                            <td>{{ formatRupiah($post['boq_plan']) }}</td>
                            <td>{{ $post['boq_desc'] }}</td>
                            <td>
                                <a href="/proyek/{{ $post->project_id }}" class="btn btn-sm btn-success"><i
                                        class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="col mt-5 text-center">
            <h3>No Data Found.</h3>
        </div>
    @endif
@endsection
