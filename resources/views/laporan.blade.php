@extends('layouts.main')

@section('body')
    <h1 class="mb-4">Laporan Proyek</h1>
    <div class="mb-4 small">
        <table class="table table-striped table-hover align-middle" id="dataTable">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Tanggal</th>
                    <th scope="col">Area Pekerjaan</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Nilai BOQ Plan</th>
                    <th scope="col">Nilai BOQ Aktual</th>
                    <th scope="col">Biaya Perusahaan</th>
                    <th scope="col">DP Subcon</th>
                    <th scope="col">Laba/Rugi</th>
                    <th scope="col">Episode</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project as $post)
                    <tr>
                        <td class="no-wrap">{{ \Carbon\Carbon::parse($post->project_date)->format('d M Y') }}</td>
                        <td><b>{{ $post->location }}</b></td>
                        <td><b>{{ $post['title'] }}</b></td>
                        <td class="no-wrap">{{ formatRupiah($post['boq_plan']) }}</td>
                        <td class="no-wrap">{{ formatRupiah($post->boq_actual) }}</td>
                        @php
                            $biaya = $post->transaction->where('category', 'Biaya Perusahaan')->sum('amount');
                        @endphp
                        <td>{{ formatRupiah($biaya) }}</td>
                        @php
                            $subcon = $post->transaction->where('category', 'DP Subcon')->sum('amount');
                        @endphp
                        <td>{{ formatRupiah($subcon) }}</td>
                        @if ($post->boq_actual != 0)
                            @php
                                $laba = $post->boq_actual - $biaya - $subcon;
                            @endphp
                        @else
                            @php
                                $laba = $post->boq_plan - $biaya - $subcon;
                            @endphp
                        @endif
                        @if ($laba >= 0)
                            <td class="table-success">
                                {{ formatRupiah($laba) }}
                            </td>
                        @else
                            <td class="table-danger">
                                {{ formatRupiah($laba) }}
                            </td>
                        @endif

                        <td class="text-center"> {{ $post->episode }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
