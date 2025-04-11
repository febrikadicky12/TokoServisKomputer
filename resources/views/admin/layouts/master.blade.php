<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard')</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Nunito&family=Poppins&display=swap" rel="stylesheet">

  <!-- NiceAdmin CSS -->
  <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

  @stack('styles')
  <style>
    main {
      min-height: 75vh;
      padding-top: 150px; /* Tambah jarak dari header */
      padding-bottom: 30px;
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="py-3 bg-primary text-white shadow-sm">
  <div class="container d-flex align-items-center justify-content-between">
    <!-- Kiri: Logo dan Judul -->
    <div class="d-flex align-items-center">
      <!-- <img src="path/to/logo.png" alt="Logo Toko Cino" style="height: 40px; margin-right: 15px;"> -->

      <div class="text-start">
        <h1 class="fw-bold mb-1" style="font-size: 1.75rem;">Toko Cino</h1>
        <p class="mb-0" style="font-size: 0.95rem;">Solusi Laptop & Komputer Anda</p>
      </div>
    </div>

    <!-- Kanan: Profile -->
    <div class="d-flex align-items-center">
      <span class="me-2" style="font-size: 0.95rem;">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
      <a href="#" class="text-white text-decoration-none">
        <i class="bi bi-person-circle" style="font-size: 1.8rem;"></i>
      </a>
    </div>
  </div>
</header>

<!-- Main Content -->
<main class="container">
  @yield('content')
</main>

<!-- Footer -->
<footer class="text-center py-3 mt-5 border-top">
  <small>&copy; {{ date('Y') }} Admin Panel. All rights reserved.</small>
</footer>

<!-- Scripts -->
<script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('NiceAdmin/assets/js/main.js') }}"></script>

@stack('scripts')
</body>
</html>
