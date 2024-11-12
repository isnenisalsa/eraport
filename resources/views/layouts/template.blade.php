<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E RAPOR</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- data tables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-white elevation-4" style="background-color: #2FCC7B">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link"
                style="text-align: center ; background-color: #FFFCF7;height: 64px;">
                <img src="{{ asset('image/Logo.png') }}" alt="adminlte Logo" class="brand-image"
                    style=" margin-left: -2%">
                <span class="brand-text font-weight-light" style="color: rgb(14, 13, 13); ">SMP IT SIRAJUL HUDA </span>
            </a>

            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div style="background-color: #FFFCF7" class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('layouts.breadcrumb')
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                @yield('content')
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- datatables dan plugins -->
    <script src="<?= asset('adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
    <!-- adminlte App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- adminlte for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "ordering": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({

                "pageLength": 6,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Tampilkan MENU entri",
                    "loadingRecords": "Memuat...",
                    "processing": "Sedang memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ditemukan data yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                },
            });
        });
    </script>
</body>

</html>
