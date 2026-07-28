@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-4">
                <i class="fas fa-credit-card text-success me-2"></i>Finalizar Compra
            </h2>
        </div>
    </div>

    <div class="row">
        {{-- Formulario de información de entrega --}}
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Información de Entrega
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Mostrar errores --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Nombre Completo</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                       value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Teléfono</label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                       value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label fw-semibold">Ciudad</label>
                                <input type="text" id="city" name="city" class="form-control"
                                       value="{{ old('city') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Dirección Completa</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label fw-semibold">Notas Adicionales (Opcional)</label>
                            <textarea id="notes" name="notes" class="form-control" rows="2"
                                      placeholder="Instrucciones especiales de entrega...">{{ old('notes') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check me-2"></i>Confirmar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Resumen del pedido --}}
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt me-2"></i>Resumen del Pedido
                    </h5>
                </div>
                <div class="card-body">
                    @foreach ($cartSummary['items'] as $item)
                        @php
                            $price     = $item['price'];
                            $quantity  = $item['quantity'];
                            $lineTotal = $price * $quantity;
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                <small class="text-dark-muted">Cantidad: {{ $quantity }}</small>
                            </div>
                            <span class="fw-semibold">
                                ${{ number_format($lineTotal, 0, ',', '.') }}
                            </span>
                        </div>
                        <hr class="my-2">
                    @endforeach

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span class="fw-semibold">
                            ${{ number_format($cartSummary['subtotal'], 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-success">
                        <span>Descuento (10%):</span>
                        <span class="fw-semibold">
                            -${{ number_format($cartSummary['discount'], 0, ',', '.') }}
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="h5 fw-bold">Total:</span>
                        <span class="h5 fw-bold text-success">
                            ${{ number_format($cartSummary['total'], 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Envío gratuito en compras superiores a $50.000</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
