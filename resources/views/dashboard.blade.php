@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts / Icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" rel="stylesheet" />
    <link href="{{ asset('soft-ui-dashboard/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('soft-ui-dashboard/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Soft UI CSS -->
    <link id="pagestyle" href="{{ asset('soft-ui-dashboard/assets/css/soft-ui-dashboard.css?v=1.0.3') }}"
        rel="stylesheet" />

    <style>
        body {
            font-family: "Inter", sans-serif !important;
        }

        .soft-card {
            border-radius: 18px;
            transition: all 0.2s ease-in-out;
            background: linear-gradient(145deg, #ffffff, #e8e8e8);
            box-shadow: 6px 6px 14px #d1d1d1,
                -6px -6px 14px #ffffff;
        }

        .soft-card:hover {
            transform: translateY(-4px);
            box-shadow: 4px 4px 10px #cfcfcf,
                -4px -4px 10px #ffffff;
        }

        .icon-box {
            padding: 12px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6dd5fa, #2980b9);
            color: white;
        }

        .navbar-blur {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.65) !important;
        }

        .logout-btn {
            transition: color 0.2s;
        }

        .logout-btn:hover {
            color: #e63946 !important;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-sm navbar-blur border-radius-xl" id="navbarBlur">
            <div class="container-fluid py-2 px-3">

                <div>
                    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0">
                        <li class="breadcrumb-item text-sm opacity-6"><a class="text-dark">Home</a></li>
                        <li class="breadcrumb-item text-sm text-dark active">Dashboard</li>
                    </ol>
                    <h5 class="font-weight-bolder mb-0">Dashboard</h5>
                </div>

                <div class="collapse navbar-collapse mt-sm-0 mt-2" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <ul class="navbar-nav justify-content-end ms-3">

                        <li class="nav-item d-flex align-items-center">
                            <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                @csrf
                                <button type="submit"
                                    class="nav-link text-body font-weight-bold px-0 bg-transparent border-0">
                                    <i class="fa fa-sign-out-alt fa-lg me-2"></i>
                                    <span class="logout-btn">Logout</span>
                                </button>
                            </form>
                        </li>

                        <li class="nav-item px-3 d-flex align-items-center">
                            <a class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Statistik -->
        <div class="container-fluid py-4">

            <div class="row">

                <!-- Film -->
                <div class="col-xl-6 col-sm-6 mb-4">
                    <a href="{{ route('film.index') }}" class="text-decoration-none">
                        <div class="card soft-card shadow-sm border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-primary mb-0">{{ $film }}</h4>
                                    <small class="text-secondary">Total Film</small>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-film fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Genre -->
                <div class="col-xl-6 col-sm-6 mb-4">
                    <a href="{{ route('genre.index') }}" class="text-decoration-none">
                        <div class="card soft-card shadow-sm border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-primary mb-0">{{ $genre }}</h4>
                                    <small class="text-secondary">Total Genre</small>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-palette fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <div class="row">

                <!-- Negara -->
                <div class="col-xl-6 col-sm-6 mb-4">
                    <a href="{{ route('negara.index') }}" class="text-decoration-none">
                        <div class="card soft-card shadow-sm border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-primary mb-0">{{ $negara }}</h4>
                                    <small class="text-secondary">Total Negara</small>
                                </div>
                                <div class="icon-box">
                                    <i class="fas fa-globe fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- User -->
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card soft-card shadow-sm border-0">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-primary mb-0">{{ $user }}</h4>
                                <small class="text-secondary">Total User</small>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

</body>

</html>
@endsection
