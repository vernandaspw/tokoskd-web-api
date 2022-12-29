<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko SKD</title>
    <!-- PWA  -->
    <meta name="theme-color" content="#1F8767" />
    {{-- <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}"> --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/plugins/select2/css/select2.min.css') }}">
    {{-- MDB4 --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/MDB-Free_4.20.0/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/MDB-Free_4.20.0/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/MDB-Free_4.20.0/css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/MDB-Free_4.20.0/css/style.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('vendor/sweatalert2/sweetalert2.min.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- VEnDOR --}}
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>

    @livewireStyles



</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm @if(session('darkmode'))
dark-mode
@endif">
    <div class="wrapper">

        @auth
        <livewire:component.navbar />

        <livewire:component.sidebar />

        @yield('content')
        {{-- <footer class="main-footer">
    <strong>&copy; 2022-{{ date('Y') }} <a href="https://adminlte.io">vernandaspw</a>.</strong>
        All rights reserved.
        </footer> --}}
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
        @else
        @yield('content')
        <footer class="d-block bg-white text-center py-2 fixed-bottom">
            <strong>&copy; 2022-{{ date('Y') }} <a href="https://www.instagram.com/vernandaspw/">vernandaspw</a>.</strong>
            All rights reserved.
        </footer>
        @endauth


    </div>

    {{-- ============================================================================ --}}

    @livewireScripts

    {{-- <script src="{{ asset('vendor/livewire/livewire.js') }}"></script> --}}

    {{-- PWA --}}
    {{-- <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }

    </script> --}}



    <script src="{{ asset('vendor/sweatalert2/sweetalert2.all.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('vendor/AdminLTE-3.2.0/dist/js/pages/dashboard.js') }}"></script>


    {{-- MDB4 --}}
    {{-- <script src="{{ asset('vendor/MDB-Free_4.20.0/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/MDB-Free_4.20.0/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/MDB-Free_4.20.0/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/MDB-Free_4.20.0/js/mdb.min.js') }}"></script>
    <script src="{{ asset('vendor/MDB-Free_4.20.0/js/addons/datatables.min.js') }}"></script> --}}
<!-- Select2 -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
crossorigin="anonymous"></script> --}}

{{-- SELECT2 --}}
<script src="{{ asset('vendor/jquery-3.5.1.slim.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- SELECT2 END --}}

@stack('script')


    <script>
        Livewire.on('success', data => {
            console.log(data.pesan);
            Swal.fire({
                position: 'top-end'
                , title: 'success!'
                , text: data.pesan
                , icon: 'success',
                // confirmButtonText: 'oke'
                showConfirmButton: false
                , timer: 1500
            })
        })
        Livewire.on('error', data => {
            console.log(data.pesan);
            Swal.fire({
                position: 'top-end'
                , title: 'error!'
                , text: data.pesan
                , icon: 'error',
                // confirmButtonText: 'oke'
                showConfirmButton: false
                , timer: 1500
            })
        })

    </script>

</body>

</html>
