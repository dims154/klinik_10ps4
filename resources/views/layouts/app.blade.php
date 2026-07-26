<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Informasi Klinik') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                Sistem Informasi Klinik
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                {{-- MENU KIRI --}}
                <ul class="navbar-nav me-auto">

                    @auth

                    {{-- DATA KLINIK --}}
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">

                            Data Klinik

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('dokter.index') }}">
                                    Data Dokter
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('dokter.create') }}">
                                    Tambah Dokter
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('pasiens.index') }}">
                                    Data pasiens
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('pasiens.create') }}">
                                    Tambah pasiens
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('administrasi.index') }}">
                                    Data Administrasi
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('administrasi.create') }}">
                                    Tambah Administrasi
                                </a>
                            </li>

                        </ul>

                    </li>

                    {{-- LAPORAN --}}
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">

                            Laporan

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('dokter.laporan') }}">
                                    Laporan Dokter
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('pasiens.laporan') }}">
                                    Laporan pasiens
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('administrasi.laporan') }}">
                                    Laporan Administrasi
                                </a>
                            </li>

                        </ul>

                    </li>

                    @endauth

                </ul>

                {{-- MENU KANAN --}}
                <ul class="navbar-nav ms-auto">

                    @guest

                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('login') }}">
                                    Login
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('register') }}">
                                    Register
                                </a>
                            </li>
                        @endif

                    @else

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown"
                               class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-bs-toggle="dropdown">

                                {{ Auth::user()->name }}

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">

                                        Logout

                                    </a>

                                </li>

                            </ul>

                            <form id="logout-form"
                                  action="{{ route('logout') }}"
                                  method="POST"
                                  class="d-none">

                                @csrf

                            </form>

                        </li>

                    @endguest

                </ul>

            </div>

        </div>
    </nav>

    <main class="py-4">

        <div class="container">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>