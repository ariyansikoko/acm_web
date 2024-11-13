<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .no-wrap {
            white-space: nowrap;
        }

        @media print {

            .print-header,
            .print-table {
                width: 100%;
                page-break-inside: avoid;
                /* Prevent breaking within headers and tables */
            }

            .print-table {
                page-break-after: auto;
                /* Allow the first table to break across pages when necessary */
            }

            .print-table+.print-header {
                page-break-before: auto;
                /* Allow the header after the first table to break across pages */
            }
        }
    </style>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body onload="window.print()">
    <div class="container mt-4">
        <h5 class="my-3 text-center print-header">{{ $header }}</h5>
        <div class="col-md-4 mx-auto">
            <table class="table table-sm small">
                <tr class="align-bottom">
                    <td class="text-end">
                        @if ($employee->image_self)
                            <img src="{{ asset('storage/' . $employee->image_self) }}" alt="{{ $employee->name }}"
                                style="max-height: 200px; width: auto">
                        @else
                            <img src="/images/placeholderpasfoto.png" alt="{{ $employee->name }}"
                                style="max-height: 200px; width: auto">
                        @endif
                    </td>
                    <td>
                        @if ($employee->image_ktp)
                            <img src="{{ asset('storage/' . $employee->image_ktp) }}" alt="{{ $employee->name }}"
                                style="max-height: 200px; width: auto">
                        @else
                            <img src="/images/placeholderktp.jpg" alt="{{ $employee->name }}"
                                style="max-height: 200px; width: auto">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    @if ($employee->quit_status == 'Aktif')
                        <td class="text-success"><b>Aktif</b></td>
                    @else
                        <td><b class="text-danger">Berhenti</b>,
                            {{ \Carbon\Carbon::parse($employee->quit_date)->format('d M Y') }}</td>
                    @endif

                </tr>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{ $employee->employee_id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nama</th>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Lahir</th>
                    <td>{{ \Carbon\Carbon::parse($employee->birth_date)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th scope="row">Alamat Sekarang</th>
                    <td>{{ $employee->address }}</td>
                </tr>
                <tr>
                    <th scope="row">No HP</th>
                    <td>{{ $employee->phone_number }}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Mulai Kerja</th>
                    <td>{{ \Carbon\Carbon::parse($employee->start_date)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th scope="row">Lokasi Kerja</th>
                    <td>{{ $employee->work_location }}</td>
                </tr>
                <tr>
                    <th scope="row">Bagian</th>
                    <td>{{ $employee->department }}</td>
                </tr>
                <tr>
                    <th scope="row">Jabatan</th>
                    <td>{{ $employee->position->title }}</td>
                </tr>
                <tr>
                    <th scope="row">Gaji</th>
                    <td>{{ formatRupiah($employee->salary) }}</td>
                </tr>
                <tr>
                    <th scope="row">Nama Bank</th>
                    <td>{{ $employee->bank_name }}</td>
                </tr>
                <tr>
                    <th scope="row">No Rekening</th>
                    <td>{{ $employee->account_number }}</td>
                </tr>
                <tr>
                    <th scope="row">No KTP</th>
                    <td>{{ $employee->ktp_number }}</td>
                </tr>
                <tr>
                    <th scope="row">No BPJS</th>
                    <td>{{ $employee->bpjs }}</td>
                </tr>
                <tr>
                    <th scope="row">NPWP</th>
                    <td>{{ $employee->npwp }}</td>
                </tr>
                <tr>
                    <th scope="row">Status PTKP</th>
                    <td>{{ $employee->ptkp_status }}</td>
                </tr>
                <tr>
                    <th scope="row">Golongan Darah</th>
                    <td>{{ $employee->blood_type }}</td>
                </tr>
                <tr>
                    <th scope="row">Emergency Contact</th>
                    <td>{{ $employee->emergency_contact . ' - ' . $employee->emergency_number }}</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
