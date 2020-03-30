<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle','SmartTech - Responsive Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description">
    <meta content="Mannatthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('contants/admin') }}/assets/images/favicon.ico">
    <link href="{{ asset('contants/admin') }}/assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="{{ asset('contants/admin') }}/assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet">
    <link href="{{ asset('contants/admin') }}/assets/plugins/toast/jquery.toast.css" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('contants/admin') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('contants/admin') }}/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('contants/admin') }}/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    @stack('css')
    <link href="{{ asset('contants/admin') }}/assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .invalid-feedback{
            display: inline-block;
        }
    </style>
</head>
<body>
    <!-- Top Bar Start -->
    @include('layouts.partials.admin.topbar')
    <!-- Top Bar End -->
    <div class="page-wrapper">
        <!-- Left Sidenav -->
        @include('layouts.partials.admin.sidebar')
        <!-- end left-sidenav-->
        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container -->
            <footer class="footer text-center text-sm-left">&copy; 2019 Metrica <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Mannatthemes</span></footer>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <script src="{{ asset('contants/admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/js/metisMenu.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/js/waves.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/js/jquery.slimscroll.min.js"></script>

    <script src="{{ asset('contants/admin') }}/assets/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/toast/jquery.toast.js"></script>

    
    @stack('js')
    <!-- App js -->
    <script src="{{ asset('contants/admin') }}/assets/js/app.js"></script>
</body>
</html>