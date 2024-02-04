@extends('layouts.main')

@section('body')
    <h1 class="mb-4 text-center">Daftar Proyek</h1>

    @if ($project->count())
        <div class="mb-4">
            <table class="table table-striped table-hover align-middle small" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Tanggal Input</th>
                        <th scope="col">Area Kerja</th>
                        <th scope="col">Jenis Proyek</th>
                        <th scope="col">Nama Pekerjaan</th>
                        <th scope="col">Nilai BOQ Plan</th>
                        <th scope="col">Nilai BOQ Subcon</th>
                        <th scope="col">Keterangan BOQ</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project as $post)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                            <td>{{ $post['location'] }}</td>
                            <td>{{ $post['type'] }}</td>
                            <a href="/proyek/{{ $post->slug }}">
                                <td>{{ $post['title'] }}</td>
                            </a>
                            <td>{{ formatRupiah($post['boq_plan']) }}</td>
                            <td>{{ formatRupiah($post['boq_subcon']) }}</td>
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
