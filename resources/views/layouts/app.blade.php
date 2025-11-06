<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    <title>
        ReFilms
    </title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('soft-ui-dashboard/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('soft-ui-dashboard/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('soft-ui-dashboard/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('soft-ui-dashboard/assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />
     {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

     {{-- <script src="https://cdn.tailwindcss.com"></script>e --}}
</head>

<body class="g-sidenav-show ">

    @include('layouts.sidebar')


    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('soft-ui-dashboard/assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('soft-ui-dashboard/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('soft-ui-dashboard/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('soft-ui-dashboard/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{ asset('soft-ui-dashboard/assets/js/plugins/chartjs.min.js')}}"></script>



</body>

</html>
