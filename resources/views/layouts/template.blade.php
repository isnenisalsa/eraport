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

    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
        <aside class="main-sidebar sidebar-light-light elevation-4" style="background-color: #22ff77;">
            <p class="brand-link" style="text-align: center; background-color: #FFFCF7;height: 68px;">
                <img src="{{ asset('image/Logo.png') }}" alt="adminlte Logo" class="brand-image"
                    style="margin-left: 4%">
                <span class="brand-text font-weight-light" style="color: rgb(14, 13, 13); font: bold"> SMP IT SIRAJUL
                    HUDA </span>
            </p>
            @include('layouts.sidebar')
        </aside>

        <div style="background-color: #FFFCF7" class="content-wrapper">
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
    <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
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
        $(function() {
            $("#example1").DataTable({
                "ordering": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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


        $(document).ready(function() {
            $('#siswa_id').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modal-tambah-data-siswa')
            });
        });
        $(document).ready(function() {
            $('#siswa_id_eskul').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modal-tambah-data-eskul')
            });
        });
        $('.select2').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#modal-tambah-data-eskul'),
            dropdownCssClass: 'select2-scrollable',
            minimumResultsForSearch: 0,
            placeholder: 'Cari siswa...',

        });
        $(document).ready(function() {
            $('#tahun_ajaran_id').select2({
                placeholder: "Pilih Tahun Ajaran",
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('[id^="tahun_ajaran_id_edit"]').each(function() {
                $(this).select2({
                    placeholder: "Pilih Tahun Ajaran",
                    allowClear: true
                });
            });
        });


        $(document).ready(function() {
            var table = $('#tabel_absensi_walas').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "searchDelay": 500, // Menambahkan delay untuk pencarian
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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
                    }
                }
            });

            var defaultYear = $('#filter-tahun-ajaran').val(); // Tahun ajaran terbaru
            var defaultSemester = $('#filter-semester').val(); // Semester terbaru

            // Terapkan filter awal berdasarkan nilai default
            if (defaultYear || defaultSemester) {
                $('#tabel_absensi_walas').fadeOut(300, function() {
                    if (defaultYear) {
                        table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                            .search(defaultYear)
                            .draw();
                    }

                    if (defaultSemester) {
                        table.column(5) // Kolom ke-5 adalah "Semester"
                            .search(defaultSemester)
                            .draw();
                    }

                    // Setelah filter diterapkan, tampilkan tabel dengan animasi
                    $('#tabel_absensi_walas').fadeIn(300);
                });
            }

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                var selectedYear = $(this).val();
                $('#tabel_absensi_walas').fadeOut(300, function() {
                    table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                        .search(selectedYear)
                        .draw();
                    $('#tabel_absensi_walas').fadeIn(300);
                });
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                var selectedSemester = $(this).val();
                $('#tabel_absensi_walas').fadeOut(300, function() {
                    table.column(5) // Kolom ke-5 adalah "Semester"
                        .search(selectedSemester)
                        .draw();
                    $('#tabel_absensi_walas').fadeIn(300);
                });
            });
        });

        $(document).ready(function() {
            var table = $('#tabel_eskul_walas').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "searchDelay": 500, // Menambahkan delay untuk pencarian
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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
                    }
                }
            });

            var defaultYear = $('#filter-tahun-ajaran').val(); // Tahun ajaran terbaru
            var defaultSemester = $('#filter-semester').val(); // Semester terbaru

            // Terapkan filter awal berdasarkan nilai default
            if (defaultYear || defaultSemester) {
                $('#tabel_eskul_walas').fadeOut(300, function() {
                    if (defaultYear) {
                        table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                            .search(defaultYear)
                            .draw();
                    }

                    if (defaultSemester) {
                        table.column(5) // Kolom ke-5 adalah "Semester"
                            .search(defaultSemester)
                            .draw();
                    }

                    // Setelah filter diterapkan, tampilkan tabel dengan animasi
                    $('#tabel_eskul_walas').fadeIn(300);
                });
            }

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                var selectedYear = $(this).val();
                $('#tabel_eskul_walas').fadeOut(300, function() {
                    table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                        .search(selectedYear)
                        .draw();
                    $('#tabel_eskul_walas').fadeIn(300);
                });
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                var selectedSemester = $(this).val();
                $('#tabel_eskul_walas').fadeOut(300, function() {
                    table.column(5) // Kolom ke-5 adalah "Semester"
                        .search(selectedSemester)
                        .draw();
                    $('#tabel_eskul_walas').fadeIn(300);
                });
            });
        });
        $(document).ready(function() {
            var table = $('#tabel_nilaiakhir_walas').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "searchDelay": 500, // Menambahkan delay untuk pencarian
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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
                    }
                }
            });

            var defaultYear = $('#filter-tahun-ajaran').val(); // Tahun ajaran terbaru
            var defaultSemester = $('#filter-semester').val(); // Semester terbaru

            // Terapkan filter awal berdasarkan nilai default
            if (defaultYear || defaultSemester) {
                $('#tabel_nilaiakhir_walas').fadeOut(300, function() {
                    if (defaultYear) {
                        table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                            .search(defaultYear)
                            .draw();
                    }

                    if (defaultSemester) {
                        table.column(5) // Kolom ke-5 adalah "Semester"
                            .search(defaultSemester)
                            .draw();
                    }

                    // Setelah filter diterapkan, tampilkan tabel dengan animasi
                    $('#tabel_nilaiakhir_walas').fadeIn(300);
                });
            }

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                var selectedYear = $(this).val();
                $('#tabel_nilaiakhir_walas').fadeOut(300, function() {
                    table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                        .search(selectedYear)
                        .draw();
                    $('#tabel_nilaiakhir_walas').fadeIn(300);
                });
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                var selectedSemester = $(this).val();
                $('#tabel_nilaiakhir_walas').fadeOut(300, function() {
                    table.column(5) // Kolom ke-5 adalah "Semester"
                        .search(selectedSemester)
                        .draw();
                    $('#tabel_nilaiakhir_walas').fadeIn(300);
                });
            });
        });
        $(document).ready(function() {
            var table = $('#tabel_rapor_walas').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "searchDelay": 500, // Menambahkan delay untuk pencarian
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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
                    }
                }
            });

            var defaultYear = $('#filter-tahun-ajaran').val(); // Tahun ajaran terbaru
            var defaultSemester = $('#filter-semester').val(); // Semester terbaru

            // Terapkan filter awal berdasarkan nilai default
            if (defaultYear || defaultSemester) {
                $('#tabel_rapor_walas').fadeOut(300, function() {
                    if (defaultYear) {
                        table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                            .search(defaultYear)
                            .draw();
                    }

                    if (defaultSemester) {
                        table.column(5) // Kolom ke-5 adalah "Semester"
                            .search(defaultSemester)
                            .draw();
                    }

                    // Setelah filter diterapkan, tampilkan tabel dengan animasi
                    $('#tabel_rapor_walas').fadeIn(300);
                });
            }

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                var selectedYear = $(this).val();
                $('#tabel_rapor_walas').fadeOut(300, function() {
                    table.column(4) // Kolom ke-4 adalah "Tahun Ajaran"
                        .search(selectedYear)
                        .draw();
                    $('#tabel_rapor_walas').fadeIn(300);
                });
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                var selectedSemester = $(this).val();
                $('#tabel_rapor_walas').fadeOut(300, function() {
                    table.column(5) // Kolom ke-5 adalah "Semester"
                        .search(selectedSemester)
                        .draw();
                    $('#tabel_rapor_walas').fadeIn(300);
                });
            });
        });
        $(document).ready(function() {
            var table = $('#tabel_pembelajaran_guru').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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

            var defaultYear = $('#filter-tahun-ajaran').val(); // Tahun ajaran terbaru
            var defaultSemester = $('#filter-semester').val(); // Semester terbaru

            // Terapkan filter awal berdasarkan nilai default dengan efek fade
            if (defaultYear || defaultSemester) {
                $('#tabel_pembelajaran_guru').fadeOut(300, function() {
                    if (defaultYear) {
                        table.column(3) // Kolom ke-4 adalah "Tahun Ajaran"
                            .search(defaultYear)
                            .draw();
                    }

                    if (defaultSemester) {
                        table.column(4) // Kolom ke-5 adalah "Semester"
                            .search(defaultSemester)
                            .draw();
                    }

                    // Setelah filter diterapkan, tampilkan tabel dengan animasi
                    $('#tabel_pembelajaran_guru').fadeIn(300);
                });
            }

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                var selectedYear = $(this).val();
                $('#tabel_pembelajaran_guru').fadeOut(300, function() {
                    table.column(3) // Kolom ke-4 adalah "Tahun Ajaran"
                        .search(selectedYear)
                        .draw();
                    $('#tabel_pembelajaran_guru').fadeIn(300);
                });
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                var selectedSemester = $(this).val();
                $('#tabel_pembelajaran_guru').fadeOut(300, function() {
                    table.column(4) // Kolom ke-5 adalah "Semester"
                        .search(selectedSemester)
                        .draw();
                    $('#tabel_pembelajaran_guru').fadeIn(300);
                });
            });
        });
        $(document).ready(function() {
            var table = $('#tabel_kelas_siswa').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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

            var defaultYear = $('#filter-tahun-ajaran').val(); // Tahun ajaran terbaru
            var defaultSemester = $('#filter-semester').val(); // Semester terbaru

            // Terapkan filter awal berdasarkan nilai default dengan efek fade
            if (defaultYear || defaultSemester) {
                $('#tabel_kelas_siswa').fadeOut(300, function() {
                    if (defaultYear) {
                        table.column(3) // Kolom ke-4 adalah "Tahun Ajaran"
                            .search(defaultYear)
                            .draw();
                    }

                    if (defaultSemester) {
                        table.column(4) // Kolom ke-5 adalah "Semester"
                            .search(defaultSemester)
                            .draw();
                    }

                    // Setelah filter diterapkan, tampilkan tabel dengan animasi
                    $('#tabel_kelas_siswa').fadeIn(300);
                });
            }

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                var selectedYear = $(this).val();
                $('#tabel_kelas_siswa').fadeOut(300, function() {
                    table.column(3) // Kolom ke-4 adalah "Tahun Ajaran"
                        .search(selectedYear)
                        .draw();
                    $('#tabel_kelas_siswa').fadeIn(300);
                });
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                var selectedSemester = $(this).val();
                $('#tabel_kelas_siswa').fadeOut(300, function() {
                    table.column(4) // Kolom ke-5 adalah "Semester"
                        .search(selectedSemester)
                        .draw();
                    $('#tabel_kelas_siswa').fadeIn(300);
                });
            });
        });



        $(document).ready(function() {
            var table = $('#tabel_siswa').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "info": false,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan START sampai END dari TOTAL entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_entri total)",
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
