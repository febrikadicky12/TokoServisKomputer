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
</head>
<body>

  <!-- Header -->
  <header class="py-3 bg-primary text-white text-center shadow">
    <h1 class="mb-0">Toko Cino</h1>
  </header>

  <!-- Main Content -->
  <main class="container mt-4">
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
