<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js">
    </script>

    {{-- select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <style>
        #dataTable {
            font-size: 12px;
            margin-bottom: 10px;
            /* Adjust the font size */
        }

        #dataTable th,
        #dataTable td {
            padding: 5px;
            /* Adjust the padding */
        }

        #dataTable_filter {
            margin-bottom: 20px;
        }

        .no-wrap {
            white-space: nowrap;
        }

        .nav-link {
            font-size: 18px;
        }
    </style>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    @include('partials.navbar')
    <div class="container mt-4">
        @yield('body')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [{
                    "type": "date-eu",
                    "targets": 0, // Assuming the date column is the second column (index 1)
                    "render": function(data, type, row, meta) {
                        if (type === 'sort') {
                            // Convert the date to a format that can be sorted naturally
                            return new Date(data).toISOString();
                        }

                        // Display the date in the "dd MMMM YYYY" format (full month name)
                        const date = new Date(data);
                        const day = date.toLocaleString('en-US', {
                            day: '2-digit'
                        });
                        const month = date.toLocaleString('en-US', {
                            month: 'short'
                        });
                        const year = date.toLocaleString('en-US', {
                            year: 'numeric'
                        });

                        return `${day} ${month} ${year}`;
                    }
                }],
                dom: 'Bftip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                pagingType: 'simple',
                fixedColumns: {
                    left: 5,
                },
            });
        });
    </script>
</body>

</html>
