<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin - Mini Tienda')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-4pPtJciY+ST/X9JoBKoKo8npxKLgt8cfWnRS8xvUEZ8AT7DO3Ha2rFUrXWXFGx92Q8BySOokJAw0+SkJ7vRlw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/custom.js'])
  @stack('styles')
  <style>
    :root {
      --neon-cyan: #00ffe7;
      --dark-bg: #0a0a14;
      --sidebar-bg: #0f0f1a;
      --card-bg: #1a1a2e;
    }
    body {
      background: var(--dark-bg);
      color: #e0e0e0;
      font-family: 'Nunito', sans-serif;
      margin: 0;
      padding: 0;
    }
    .admin-layout { display: flex; min-height: 100vh; }
    .admin-sidebar {
      width: 260px;
      min-height: 100vh;
      background: linear-gradient(180deg, #0f0f1a 0%, #1a1a2e 100%);
      border-right: 1px solid #2a2a3e;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 100;
      overflow-y: auto;
      transition: transform 0.3s ease;
    }
    .admin-sidebar .sidebar-brand {
      padding: 1.5rem;
      border-bottom: 1px solid #2a2a3e;
    }
    .admin-sidebar .nav-link {
      color: #b0b0d0;
      padding: 0.75rem 1.5rem;
      border-radius: 0;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
    }
    .admin-sidebar .nav-link:hover,
    .admin-sidebar .nav-link.active {
      color: var(--neon-cyan);
      background: rgba(0, 255, 231, 0.08);
      border-left-color: var(--neon-cyan);
    }
    .admin-sidebar .nav-link i { width: 20px; text-align: center; margin-right: 0.75rem; }
    .admin-main {
      margin-left: 260px;
      flex: 1;
      min-height: 100vh;
    }
    .admin-topbar {
      background: #12121c;
      border-bottom: 1px solid #2a2a3e;
      padding: 0.75rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .admin-content { padding: 1.5rem; }
    .card-bg { background: var(--card-bg); border: 1px solid #2a2a3e; border-radius: 0.75rem; }
    .table-dark td, .table-dark th { border-color: #2a2a3e; }
    .btn-gradient-primary {
      background: linear-gradient(135deg, var(--neon-cyan), #00b8c5);
      color: #000; border: none;
    }
    .btn-gradient-primary:hover {
      background: linear-gradient(135deg, #00e6ce, #009ba5);
      box-shadow: 0 0 8px rgba(0, 255, 231, 0.4);
    }
    .form-control, .form-select {
      background-color: #101020; color: #e0e0e0;
      border: 1px solid #333; border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--neon-cyan);
      box-shadow: 0 0 0 0.2rem rgba(0, 255, 231, 0.25);
    }
    .alert { background-color: #2d2d3a; color: #ffcccc; border: none; border-radius: 0.5rem; }
    .text-cyan { color: var(--neon-cyan) !important; }
    .neon-glow { text-shadow: 0 0 8px rgba(0, 255, 231, 0.4); }
    .text-dark-muted { color: #c0c0d8 !important; }
    .label-muted { color: #a0a0c0 !important; }
    @media (max-width: 768px) {
      .admin-sidebar { transform: translateX(-100%); }
      .admin-sidebar.show { transform: translateX(0); }
      .admin-main { margin-left: 0; }
    }
  </style>
</head>
<body>
<div class="admin-layout">
  <aside class="admin-sidebar" id="adminSidebar">
    <nav class="py-3">
      <div class="px-3 mb-2">
        <small class="text-uppercase fw-semibold" style="color:#a0a0c0;">Men&uacute;</small>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>Dashboard Admin
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.products') }}">
            <i class="fas fa-box"></i>Productos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.categories') }}">
            <i class="fas fa-tags"></i>Categor&iacute;as
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-users"></i>Usuarios
          </a>
        </li>
      </ul>
      <div class="px-3 mt-4 mb-2">
        <small class="text-uppercase fw-semibold" style="color:#a0a0c0;">Cuenta</small>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-id-card-alt"></i>Mi Perfil
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('orders.history') }}">
            <i class="fas fa-receipt"></i>Mis Pedidos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>Cerrar Sesi&oacute;n
          </a>
          <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
  </aside>
  <div class="admin-main">
    <div class="admin-topbar">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-outline-secondary d-md-none me-2" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div class="d-flex align-items-center gap-3">
        <span class="text-cyan fw-bold"><i class="fas fa-cogs me-1"></i>Panel Admin</span>
        <div class="dropdown">
          <a class="text-white text-decoration-none dropdown-toggle" href="#" id="adminUserMenu" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="adminUserMenu">
            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-id-card-alt me-2"></i>Mi Perfil</a></li>
            <li><a class="dropdown-item" href="{{ route('orders.history') }}"><i class="fas fa-receipt me-2"></i>Mis Pedidos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesi&oacute;n</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="admin-content">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      @yield('content')
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
@stack('scripts')
</body>
</html>