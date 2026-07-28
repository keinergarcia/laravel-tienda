<nav class="navbar navbar-expand-lg position-relative z-3"
     style="background: linear-gradient(135deg, #0f0f0f, #1a1a2e); box-shadow: 0 4px 15px rgba(0, 255, 255, 0.08);">
  <div class="container">
    {{-- Marca con efecto neón --}}
    <a class="navbar-brand fs-3 fw-bold text-cyan neon-glow d-flex align-items-center" href="{{ route('home') }}">
      <i class="fas fa-store-alt fa-lg me-2"></i>Mini Tienda
    </a>

    {{-- Toggler futurista --}}
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Alternar navegación">
      <span class="navbar-toggler-icon" style="filter: invert(1) drop-shadow(0 0 6px var(--neon-cyan));"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="mainNav">
      @auth
        {{-- Menú de navegación --}}
        <ul class="navbar-nav">
          @foreach ([['route'=>'products.index','icon'=>'box-open','label'=>'Productos'],
                     ['route'=>'categories.index','icon'=>'tags','label'=>'Categorías'],
                     ['route'=>'products.featured','icon'=>'star','label'=>'Destacados'],
                     ['route'=>'products.popular','icon'=>'fire-alt','label'=>'Populares']] as $item)
            <li class="nav-item">
              <a class="nav-link fw-semibold text-white px-3" href="{{ route($item['route']) }}"
                 style="position: relative;">
                <i class="fas fa-{{ $item['icon'] }} me-1 neon-glow"></i>{{ $item['label'] }}
                <span class="nav-hover-underline"></span>
              </a>
            </li>
          @endforeach
          @if(Auth::check() && Auth::user()->is_admin)
          <li class="nav-item position-relative">
            <a class="nav-link fw-semibold text-white px-3" href="{{ route('admin.dashboard') }}">
              <i class="fas fa-tachometer-alt me-1 neon-glow"></i>Panel
            </a>
          </li>
          @endif
          <li class="nav-item position-relative">
            <a class="nav-link fw-semibold text-white px-3" href="{{ route('cart.index') }}">
              <i class="fas fa-shopping-cart me-1 neon-glow"></i>Carrito
              @php $count = session('cart', []) ? count(session('cart')) : 0; @endphp
              @if($count)
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                  {{ $count }}
                </span>
              @endif
            </a>
          </li>
        </ul>

    {{-- Buscador futurista --}}
<form class="d-flex mx-4" method="GET" action="{{ route('products.index') }}">
  <div class="input-group input-group-sm">
    <input class="form-control form-control-sm bg-dark text-white border-0 rounded-start-pill ps-3"
           type="search" name="search" placeholder="Buscar..."
           style="box-shadow: inset 0 0 6px rgba(0,255,255,0.5);"
           value="{{ request('search') }}">

    <button class="btn bg-transparent text-cyan rounded-end-pill border-0"
            type="submit" style="box-shadow: inset 0 0 6px rgba(0,255,255,0.3);">
      <i class="fas fa-search"></i>
    </button>
  </div>
</form>

      @endauth

      {{-- User dropdown --}}
      <ul class="navbar-nav">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white px-3 fw-semibold" href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false" style="filter: drop-shadow(0 0 4px var(--neon-cyan));">
              <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end mt-2"
                aria-labelledby="userDropdown"
                style="background: #2a2d3c; border: none; box-shadow: 0 4px 12px rgba(0,255,255,0.3); z-index: 1050;">
              <li>
                <a class="dropdown-item text-white d-flex align-items-center" href="{{ route('profile') }}">
                  <i class="fas fa-id-card-alt me-2 neon-glow"></i>Mi Perfil
                </a>
              </li>
              <li>
                <a class="dropdown-item text-white d-flex align-items-center" href="{{ route('orders.history') }}">
                  <i class="fas fa-receipt me-2 neon-glow"></i>Mis Pedidos
                </a>
              </li>
              <li><hr class="dropdown-divider bg-white"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                    <i class="fas fa-sign-out-alt me-2" style="filter: drop-shadow(0 0 4px red);"></i>Cerrar Sesión
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item me-2">
            <a class="btn btn-outline-light rounded-pill px-4 py-1" href="{{ route('register') }}"
               style="box-shadow: 0 0 6px cyan;">
              <i class="fas fa-user-plus me-1"></i>Registrarse
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light text-primary rounded-pill px-4 py-1" href="{{ route('login') }}"
               style="box-shadow: inset 0 0 6px cyan;">
              <i class="fas fa-right-to-bracket me-1"></i>Iniciar Sesión
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>

  {{-- Subrayado animado --}}
  <style>
    .nav-link {
      position: relative;
      transition: color 0.3s;
    }

    .nav-hover-underline {
      position: absolute;
      bottom: 0.25rem;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--neon-cyan);
      transition: width 0.3s ease;
    }

    .nav-link:hover .nav-hover-underline {
      width: 100%;
    }

    .dropdown-menu {
      z-index: 1050 !important;
    }

    .dropdown-menu .dropdown-item:hover {
      background-color: #373b52;
    }
  </style>
</nav>

