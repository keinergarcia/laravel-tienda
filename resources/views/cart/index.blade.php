@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold text-cyan neon-glow mb-4">
                <i class="fas fa-shopping-cart me-2"></i>Carrito de Compras
            </h2>

            @if (empty($cartSummary['items']))
                <div class="text-center py-5 fade-in-up">
                    <i class="fas fa-shopping-basket fa-4x text-neon mb-3"></i>
                    <h4 class="text-light fw-bold">Tu carrito está vacío</h4>
                    <p class="text-secondary fs-5">
                        Explora nuestros <span class="text-neon">productos</span> y agrega tus <span class="text-success">favoritos</span> 🛒
                    </p>
                    <a href="{{ route('products.index') }}" class="btn btn-gradient-primary px-4 py-2 mt-3">
                        <i class="fas fa-box-open me-2"></i>Ver Productos
                    </a>
                </div>
            @else
                <div class="row">
                    <!-- Lista de productos -->
                    <div class="col-lg-8">
                        @foreach ($cartSummary['items'] as $item)
                            <div class="card shadow-sm mb-3 border-0 bg-dark text-light fade-in-up">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ $item['product']->image ?: 'https://placehold.co/120x120?text=Producto' }}" class="rounded me-3"
                                         style="width: 80px; height: 80px; object-fit: cover;"
                                         alt="{{ $item['product']->name }}">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-white fw-bold">{{ $item['product']->name }}</h5>
                                        <p class="mb-1 text-dark-muted">Cantidad: {{ $item['quantity'] }}</p>
                                        <p class="mb-0 fw-bold text-success">Total: ${{ number_format($item['itemTotal'], 0, ',', '.') }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Eliminar este producto del carrito?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Resumen -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0 bg-dark text-light fade-in-up">
                            <div class="card-header bg-gradient-light border-0">
                                <h5 class="mb-0 text-white fw-bold">Resumen</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($cartSummary['subtotal'], 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between text-success mb-2">
                                    <span>Descuento (10%):</span>
                                    <span>- ${{ number_format($cartSummary['discount'], 0, ',', '.') }}</span>
                                </div>
                                <hr class="bg-light">
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total:</span>
                                    <span class="text-success">${{ number_format($cartSummary['total'], 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="card-footer bg-dark border-top-0 d-grid gap-2">
                                <!-- Checkout (ahora redirige al formulario de pago) -->
                                <a href="{{ route('checkout.form') }}" class="btn btn-neon-green btn-lg w-100">
                                    <i class="fas fa-credit-card me-2"></i>Proceder al Pago
                                </a>

                                <!-- Vaciar Carrito -->
                                <form method="POST" action="{{ route('cart.clear') }}"
                                      onsubmit="return confirm('¿Estás seguro de vaciar el carrito?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-light w-100">
                                        <i class="fas fa-trash me-2"></i>Vaciar Carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
