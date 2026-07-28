@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #0f0f0f, #1e1e2f);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4 fade-in-up overflow-hidden" style="background-color: #2a2d3c;">
          <div class="card-body p-5">

            {{-- Encabezado --}}
            <div class="text-center mb-4">
              <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                   style="width: 80px; height: 80px; background-color: #00ffe7; box-shadow: 0 0 12px #00ffe7;">
                <i class="fas fa-user-plus fa-2x text-dark"></i>
              </div>
              <h2 class="fw-bold text-cyan mt-3 mb-2" style="text-shadow: 0 0 8px #00ffe7;">Crear Cuenta</h2>
              <p class="text-light">Únete a la revolución de compras</p>
            </div>

            {{-- Alerta de error --}}
            @if(session('error'))
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
              </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('register') }}">
              @csrf

              {{-- Nombre --}}
              <div class="mb-3">
                <label for="name" class="form-label fw-semibold text-cyan">Nombre Completo</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-0 text-cyan">
                    <i class="fas fa-user"></i>
                  </span>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control bg-dark text-white border-0 @error('name') is-invalid @enderror"
                    placeholder="Tu nombre completo"
                    required
                  >
                </div>
                @error('name')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              {{-- Email --}}
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-cyan">Correo Electrónico</label>
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
                    placeholder="tucorreo@ejemplo.com"
                    required
                  >
                </div>
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              {{-- Contraseña --}}
              <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-cyan">Contraseña</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-0 text-cyan">
                    <i class="fas fa-lock"></i>
                  </span>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control bg-dark text-white border-0 @error('password') is-invalid @enderror"
                    placeholder="Mínimo 8 caracteres"
                    required
                  >
                </div>
                <small class="text-muted">Debe tener al menos 8 caracteres</small>
                @error('password')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold text-cyan">Confirmar Contraseña</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-0 text-cyan">
                    <i class="fas fa-lock"></i>
                  </span>
                  <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control bg-dark text-white border-0"
                    placeholder="Repite tu contraseña"
                    required
                  >
                </div>
              </div>

              {{-- Botón brillante aqua --}}
              <button type="submit"
                      class="btn w-100 py-3 fw-semibold text-uppercase"
                      style="background: linear-gradient(135deg, #00ffe7, #00c9a7); color: #000; border: none; box-shadow: 0 0 12px #00ffe7, 0 0 24px #00ffe7;">
                <i class="fas fa-user-plus me-2"></i> Crear Cuenta
              </button>
            </form>

            {{-- Enlace a login --}}
            <div class="text-center mt-4">
              <p class="text-light">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="fw-bold text-cyan text-decoration-none">Inicia sesión aquí</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
