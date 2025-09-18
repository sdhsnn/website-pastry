<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Warna tema */
        body {
            background-color: #f4ece2; /* Background halaman */
        }
        .navbar-custom {
            background-color: #B38867 !important; /* Navbar coklat hangat */
        }
        .footer-custom {
            background-color: #B38867 !important;
            border-top: 3px solid #8B4513; /* Garis pemisah coklat tua */
        }
        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand,
        .footer-custom .navbar-brand,
        .footer-custom span {
            color: #ffffff !important;
            font-weight: normal;
        }
        .table-custom thead {
            background-color: #B38867;
            color: white;
        }
        .table-custom tbody tr:nth-child(even) {
            background-color: #f4ece2;
        }
        .table-custom tbody tr:nth-child(odd) {
            background-color: #e0d4c0;
        }
        .btn-custom {
            background-color: #B38867;
            color: white;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md shadow-sm navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('riwayat.pesanan') }}">Riwayat Transaksi</a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login') || Route::has('register'))
                                <li class="nav-item dropdown">
                                    <a id="authDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                                        @if (Route::has('login'))
                                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        @endif
                                        @if (Route::has('register'))
                                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="shadow-sm mt-auto footer-custom">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <span class="ms-2">&copy; {{ date('Y') }} All Rights Reserved</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
