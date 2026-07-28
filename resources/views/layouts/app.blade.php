<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head> <link rel="icon" type="image/png" href="{{ public('favicon.png') }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Sistem Informasi Klinik') }}</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
body{font-family:'Nunito',sans-serif;background:#eef3f8}
.navbar{padding:15px 0}.navbar-brand{font-weight:bold}
.dropdown-menu{border:0;border-radius:10px;box-shadow:0 5px 20px rgba(0,0,0,.12)}
.dropdown-item:hover{background:#0d6efd;color:#fff}
.card{border:none;border-radius:15px;box-shadow:0 5px 20px rgba(0,0,0,.08)}
.card-header{background:#0d6efd;color:#fff;font-weight:bold}
</style>
</head>
<body>
<div id="app">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
<div class="container">
<a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-hospital"></i> Sistem Informasi Klinik</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav me-auto">
@auth
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Data Klinik</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="{{ route('dokter.index') }}"><i class="bi bi-person-badge"></i> Data Dokter</a></li>
<li><a class="dropdown-item" href="{{ route('dokter.create') }}"><i class="bi bi-person-plus"></i> Tambah Dokter</a></li>
<li><hr class="dropdown-divider"></li>
<li><a class="dropdown-item" href="{{ route('pasien.index') }}"><i class="bi bi-people"></i> Data Pasien</a></li>
<li><a class="dropdown-item" href="{{ route('pasien.create') }}"><i class="bi bi-person-add"></i> Tambah Pasien</a></li>
<li><hr class="dropdown-divider"></li>
<li><a class="dropdown-item" href="{{ route('administrasi.index') }}"><i class="bi bi-clipboard2-pulse"></i> Data Administrasi</a></li>
<li><a class="dropdown-item" href="{{ route('administrasi.create') }}"><i class="bi bi-plus-circle"></i> Tambah Administrasi</a></li>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Laporan</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="{{ route('dokter.laporan') }}">Laporan Dokter</a></li>
<li><a class="dropdown-item" href="{{ route('pasien.laporan') }}">Laporan Pasien</a></li>
<li><a class="dropdown-item" href="{{ route('administrasi.laporan') }}">Laporan Administrasi</a></li>
</ul>
</li>
@endauth
</ul>
<ul class="navbar-nav ms-auto">
@guest
@if(Route::has('login'))<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>@endif
@if(Route::has('register'))<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>@endif
@else
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
<ul class="dropdown-menu dropdown-menu-end">
<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</li>
@endguest
</ul>
</div></div></nav>
<main class="py-4"><div class="container">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</div></main>
<footer class="bg-white border-top py-3 mt-5"><div class="container text-center text-muted">© {{ date('Y') }} Sistem Informasi Klinik</div></footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
