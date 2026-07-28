@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #1d1f27, #3a3e54);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card shadow border-0 rounded-4" style="background-color: #2a2d3c; color: #e0e0e0;">
          <div class="card-body p-5">

            {{-- Encabezado --}}
            <div class="text-center mb-4">
              <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                   style="width: 80px; height: 80px; background-color: cyan; box-shadow: 0 0 10px cyan;">
                <i class="fas fa-shopping-basket fa-2x text-dark"></i>
              </div>
              <h2 class="fw-bold text-white mt-3 mb-2" style="text-shadow: 0 0 8px cyan;">Mini Tienda</h2>
              <p class="text-light">Inicia sesión para continuar</p>
            </div>

            {{-- Alertas --}}
            @if(session('error'))
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
              </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('login') }}">
              @csrf

              {{-- Email --}}
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-white">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-0 text-cyan">
                    <i class="fas fa-envelope"></i>
                  </span>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control bg-dark text-white border-0 @error('email') is-invalid @enderror"
                    placeholder="tu@correo.com"
                    required autofocus
                  >
                </div>
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              {{-- Password --}}
              <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-white">Contraseña</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-0 text-cyan">
                    <i class="fas fa-lock"></i>
                  </span>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control bg-dark text-white border-0 @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                    required
                  >
                </div>
                @error('password')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              {{-- Recordarme --}}
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label text-white" for="remember">Recordarme</label>
                </div>
              </div>

              {{-- Botón brillante aqua --}}
              <button type="submit" class="btn w-100 py-3 fw-semibold"
                style="background: linear-gradient(135deg, #00ffe7, #00c9a7); color: #000; box-shadow: 0 0 12px #00ffe7, 0 0 24px #00ffe7; border: none;">
                <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
              </button>
            </form>

            {{-- Enlace a registro --}}
            <div class="text-center mt-4">
              <p class="text-light mb-1">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-cyan fw-semibold">Regístrate aquí</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
