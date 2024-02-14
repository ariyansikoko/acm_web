@extends('layouts.main')

@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Daftar Proyek</h2>
        <div class="">
            <button class="btn btn-info" id="toggleColumnsBtn">Toggle Kolom Lain</button>
            <a href="/dashboard/proyek/create" class="btn btn-primary">Tambah Proyek Baru</a>
        </div>
    </div>
    <div class="mb-4 small" id="scrollX">
        <table class="table table-striped table-hover align-middle" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Proyek</th>
                    <th scope="col" class="text-center">Area Kerja</th>
                    <th scope="col">Jenis Proyek</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Nilai BOQ Plan</th>
                    <th scope="col">Nilai BOQ Aktual</th>
                    <th scope="col" id="noProject" style="display:none">Nilai Comcase</th>
                    <th scope="col">Nilai BOQ-Comcase</th>
                    <th scope="col">Nilai BOQ Subcon</th>
                    <th scope="col">No PO</th>
                    <th scope="col" id="boqDesc" style="display:none">Keterangan BOQ</th>
                    <th scope="col">EP</th>
                    <th scope="col" class="text-center">Status Budget</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td><b>{{ $post->project_id }}</b></td>
                        <td class="text-center">{{ $post['location'] }}</td>
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
                        <td>{{ $post->no_po }}</td>
                        <td id="boqDesc" style="display:none">{{ $post['boq_desc'] }}</td>
                        <td class="text-center">{{ $post['episode'] }}</td>
                        @if ($post->status == 1)
                            <td class="text-success text-center">OPEN</td>
                        @else
                            <td class="text-danger text-center">CLOSED</td>
                        @endif
                        <td class="no-wrap">
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
                $("#boqDesc, #noProject").toggle();
            });
        });
    </script>
@endsection
