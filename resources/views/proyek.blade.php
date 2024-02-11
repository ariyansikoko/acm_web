@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between">
        <h2 class="mb-4">Daftar Proyek</h2>
        <button class="btn btn-info mb-3" id="toggleColumnsBtn">Toggle Kolom Lain</button>
    </div>
    <div class="mb-4">
        <a href="/dashboard/proyek/create" class="btn btn-primary">Tambah Proyek Baru</a>
    </div>
    <div class="mb-4 small">
        <table class="table table-striped table-hover align-middle" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Proyek</th>
                    <th scope="col">Area Kerja</th>
                    <th scope="col">Jenis Proyek</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Nilai BOQ Plan</th>
                    <th scope="col">Nilai BOQ Aktual</th>
                    <th scope="col" id="noProject" style="display:none">Nilai Comcase</th>
                    <th scope="col">Nilai BOQ-Comcase</th>
                    <th scope="col">Nilai BOQ Subcon</th>
                    <th scope="col" id="noPO" style="display:none">No PO</th>
                    <th scope="col" id="boqDesc" style="display:none">Keterangan BOQ</th>
                    <th scope="col">EP</th>
                    <th scope="col">Status Budget</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td><b>{{ $post->project_id }}</b></td>
                        <td>{{ $post['location'] }}</td>
                        <td>{{ $post['type'] }}</td>
                        <td><b>{{ $post['title'] }}</b></td>
                        <td class="no-wrap">{{ formatRupiah($post['boq_plan']) }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->boq_actual) }}</td>
                        <td id="noProject" style="display:none" class="no-wrap">{{ formatRupiah($post->comcase) }}</td>
                        @if ($post->boq_actual != 0)
                            <td class="no-wrap">{{ formatRupiah($post->boq_actual - $post->comcase) }}</td>
                        @else
                            <td class="no-wrap">{{ formatRupiah($post->boq_plan - $post->comcase) }}</td>
                        @endif
                        <td class="no-wrap">{{ formatRupiah($post['boq_subcon']) }}</td>
                        <td id="noPO" style="display:none">{{ $post->no_po }}</td>
                        <td id="boqDesc" style="display:none">{{ $post['boq_desc'] }}</td>
                        <td>{{ $post['episode'] }}</td>
                        @if ($post->status == 1)
                            <td class="text-success">OPEN</td>
                        @else
                            <td class="text-danger">CLOSED</td>
                        @endif
                        <td>
                            <a href="/proyek/{{ $post->project_id }}" class="btn btn-success btn-sm"><i
                                    class="bi bi-list"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            // Button click event to toggle column visibility
            $("#toggleColumnsBtn").on("click", function() {
                $("#noPO, #boqDesc, #noProject").toggle();
            });
        });
    </script>
@endsection
