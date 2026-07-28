@extends('layouts.app')

@section('title', 'Productos Populares')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-cyan neon-glow mb-4">
        <i class="fas fa-fire text-danger me-2"></i>Productos Más Populares
    </h2>

    <div class="row">
        @foreach ($popularProducts as $index => $product)
            @php
                $discountedPrice = $product->price * 0.9;
                $savings = $product->price - $discountedPrice;
            @endphp
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark text-light fade-in-up">
                    <div class="position-relative">
                        <img src="{{ $product->image ?: 'https://placehold.co/400x300?text=Producto' }}"
                             class="card-img-top product-image"
                             alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover;">

                        @if ($index < 3)
                            <span class="badge bg-danger text-light position-absolute top-0 start-0 m-2 fw-semibold">
                                <i class="fas fa-fire me-1"></i>#{{ $index + 1 }} TOP
                            </span>
                        @endif

                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 fw-semibold">
                            <i class="fas fa-tag me-1"></i>10% OFF
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold text-white mb-0">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="text-decoration-none text-neon">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <span class="badge bg-primary">
                                {{ $product->category->name ?? 'Sin categoría' }}
                            </span>
                        </div>

<div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>{{ $product->views }} vistas
                            </small>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <span class="h5 text-success fw-bold me-2">${{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <small class="text-warning">
                                <i class="fas fa-piggy-bank me-1"></i>¡Ahorras ${{ number_format($savings, 0, ',', '.') }}!
                            </small>
                        </div>

                        <div class="mt-auto">
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-gradient-primary w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Agregar al Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
