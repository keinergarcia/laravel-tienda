<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Mini Tienda') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Fuente Nunito --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  {{-- Font Awesome 6 --}}
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-4pPtJciY+ST/X9JoBKoKo8npxKLgt8cfWnRS8xvUEZ8AT7DO3Ha2rFUrXWXFGx92Q8BySOokJAw0+SkJ7vRlw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  {{-- Bootstrap 5.3.3 --}}
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >

  {{-- Estilos compilados por Vite --}}
  @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/custom.js'])

  {{-- Estilo futurista global --}}
  <style>
    :root {
      --neon-cyan: #00ffe7;
      --neon-green: #00ff84;
      --dark-bg: #0f0f0f;
      --dark-secondary: #1e1e2f;
      --card-bg: #1a1a2e;
    }

    body {
      background: linear-gradient(135deg, var(--dark-bg), var(--dark-secondary));
      color: #e0e0e0;
      font-family: 'Nunito', sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

    .card {
      background-color: var(--card-bg);
      color: #e0e0e0;
      border: none;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.05);
    }

    .btn-primary,
    .btn-gradient-primary {
      background: linear-gradient(135deg, var(--neon-cyan), #00b8c5);
      color: #000;
      border: none;
    }

    .btn-primary:hover,
    .btn-gradient-primary:hover {
      background: linear-gradient(135deg, #00e6ce, #009ba5);
      color: #000;
      box-shadow: 0 0 8px rgba(0, 255, 231, 0.4);
      transform: translateY(-1px);
    }

    .form-control,
    .form-select {
      background-color: #101020;
      color: #e0e0e0;
      border: 1px solid #333;
      border-radius: 8px;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--neon-cyan);
      box-shadow: 0 0 0 0.2rem rgba(0, 255, 231, 0.25);
    }

    .alert {
      background-color: #2d2d3a;
      color: #ffcccc;
      border: none;
    }

    .navbar, footer {
      background-color: #12121c !important;
    }

    .nav-link {
      color: #c0c0ff !important;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      color: var(--neon-cyan) !important;
    }

    footer {
      color: #ccc;
    }

    /* Dropdown más visible */
    .dropdown-menu {
      background-color: #1f1f2d;
      border: none;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
    }

    .dropdown-item {
      color: #e0e0e0;
    }

    .dropdown-item:hover {
      background-color: #2a2d3c;
    }
  </style>

  @stack('styles')
</head>
<body class="min-vh-100 d-flex flex-column">
  <div id="app" class="d-flex flex-column min-vh-100">
    
    {{-- Header/Navbar --}}
    @include('layouts.header')

    {{-- Contenido --}}
    <main class="flex-fill py-4">
      @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
  </div>

  {{-- Bootstrap Bundle JS --}}
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    defer
  ></script>

  @stack('scripts')
</body>
</html>
