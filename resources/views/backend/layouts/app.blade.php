<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../..//theam/assets/" data-template="vertical-menu-template-starter">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Mega Solutions</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('theam/Images/logo.png')}}" />

    @include('backend.layouts.include.style')
    @yield('extrastyle')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{url('theam/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{url('theam/assets/js/config.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="background: #1f446e14;">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('backend.layouts.include.sidebar')
            <!-- / Menu -->

            @yield('content')
            <!-- Layout container -->
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('backend.layouts.include.footer')
    @include('backend.layouts.include.js')
    @yield('extrascript')

    <!-- Page JS -->

</body>

</html>
