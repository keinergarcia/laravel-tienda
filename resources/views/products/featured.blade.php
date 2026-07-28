@extends('layouts.app')

@section('title', 'Productos Destacados')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-cyan neon-glow mb-4">
        <i class="fas fa-star text-warning me-2"></i>Productos Destacados
    </h2>

    <div class="row">
        @forelse ($featuredProducts as $product)
            @php
                $discountedPrice = $product->price * 0.9;
                $savings = $product->price - $discountedPrice;
            @endphp
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark text-light fade-in-up">
                    <div class="position-relative">
                        <img src="{{ $product->image ?: 'https://placehold.co/400x300?text=Producto' }}"
                             class="card-img-top"
                             alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover;">
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 fw-semibold">
                            <i class="fas fa-star me-1"></i>Destacado
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-white mb-1">
                            <a href="{{ route('products.show', $product->id) }}"
                               class="text-decoration-none text-neon">
                                {{ $product->name }}
                            </a>
                        </h5>

                        <p class="small text-muted mb-2">{{ Str::limit($product->description, 60) }}</p>

                        <div class="mb-2">
                            <span class="h5 text-success fw-bold me-2">
                                ${{ number_format($discountedPrice, 0, ',', '.') }}
                            </span>
                            <span class="text-muted text-decoration-line-through">
                                ${{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <small class="text-warning mb-3">
                            <i class="fas fa-piggy-bank me-1"></i>Ahorras ${{ number_format($savings, 0, ',', '.') }}
                        </small>

                        <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
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
        @empty
            <div class="col-12 text-center py-5 fade-in-up">
                <i class="fas fa-star fa-4x text-warning mb-3"></i>
                <h4 class="text-light">No hay productos destacados en este momento.</h4>
                <p class="text-secondary">Vuelve más tarde o explora el catálogo completo.</p>
                <a href="{{ route('products.index') }}" class="btn btn-neon-green mt-3">
                    <i class="fas fa-box-open me-2"></i>Ver Todos los Productos
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
