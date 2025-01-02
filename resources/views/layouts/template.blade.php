<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E RAPOR</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}" />
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Ensure html and body take full height */
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        /* Make the wrapper take the full height */
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Header: fixed at the top */
        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1020;
            /* Make sure it stays above the content */
            background-color: #FFFCF7;
        }

        body:not(.layout-fixed) .main-sidebar {
            position: fixed;
            overflow: hidden;
        }


        /* Content area: scrollable with margin for the fixed sidebar and header */
        .content-wrapper {
            margin-top: 70px;
            /* Height of the header */
            margin-left: 250px;
            /* Width of the sidebar */
            padding-bottom: 50px;
            /* Space for footer */
            height: calc(100vh - 120px);
            /* Full height minus the header/footer space */
            overflow-y: auto;
        }

        /* Footer: fixed at the bottom */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1040;
            /* Above content, below sidebar */
            background-color: #3c8dbc;
            color: white;
            text-align: center;
        }

        /* Ensure content inside the content area can scroll */
        .content {
            overflow-y: auto;
            padding: 10px;
            min-height: 100%;
        }
    </style>
    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
        <aside class="main-sidebar sidebar-light-light elevation-4" style="background-color: #25D366;">
            <p class="brand-link" style="text-align: center; background-color: #FFFCF7;height: 68px;">
                <img src="{{ asset('image/logo.png') }}" alt="adminlte Logo" class="brand-image"
                    style="margin-left: 5% ;">
                <span class="brand-text font-weight-light" style="color: rgb(14, 13, 13);">
                    SMP IT SIRAJUL
                    HUDA </span>
            </p>
            @include('layouts.sidebar')
        </aside>

        <div class="content-wrapper">
            @include('layouts.breadcrumb')
            <section class="content">
                @yield('content')
            </section>
        </div>
        @include('layouts.footer')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/js.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('js')
</body>

</html>
