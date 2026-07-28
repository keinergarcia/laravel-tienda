@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <img src="{{ $product->image }}" 
                     class="card-img-top" 
                     alt="{{ $product->name }}"
                     style="height: 400px; object-fit: cover;">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="h2 fw-bold text-dark">{{ $product->name }}</h1>
                        <span class="badge bg-primary fs-6">{{ $product->category->name }}</span>
                    </div>

                    @if ($product->is_featured)
                        <div class="mt-3">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>Producto Destacado
                            </span>
                        </div>
                        @endif

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <span class="h2 text-success fw-bold me-3">
                                ${{ number_format($product->price * 0.9, 0, ',', '.') }}
                            </span>
                            <span class="h4 text-muted text-decoration-line-through">
                                ${{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="fas fa-tag me-2"></i>
                            <strong>¡10% de descuento!</strong> Ahorras ${{ number_format($product->price * 0.1, 0, ',', '.') }}
                        </div>
                    </div>

                    @if (!empty($product->description))
                        <div class="mb-4">
                            <h5 class="fw-bold">Descripción</h5>
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-gradient-primary btn-lg w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Agregar al Carrito
                            </button>
                        </form>

                        @if (auth()->user() && auth()->user()->is_admin)
                            <div class="btn-group">
                                <a href="{{ route('products.edit', $product->id) }}" 
                                   class="btn btn-outline-warning">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash me-1"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    @if ($product->is_featured)
                        <div class="mt-3">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>Producto Destacado
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Productos relacionados -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Productos Relacionados</h3>
            <div class="row">
                @foreach ($relatedProducts as $related)
                    @php
                        $discountedPrice = $related->price * 0.9;
                    @endphp
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm product-card">
                            <div class="position-relative">
                                <img src="{{ $related->image }}" 
                                     class="card-img-top product-image" 
                                     alt="{{ $related->name }}"
                                     style="height: 200px; object-fit: cover;">
                                <span class="badge bg-warning position-absolute top-0 end-0 m-2">
                                    <i class="fas fa-tag me-1"></i>10% OFF
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">
                                    <a href="{{ route('products.show', $related->id) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ $related->name }}
                                    </a>
                                </h5>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="h5 text-success fw-bold me-2">${{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                        <span class="text-muted text-decoration-line-through">${{ number_format($related->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $related->id }}">
                                        <button type="submit" class="btn btn-gradient-primary w-100">
                                            <i class="fas fa-shopping-cart me-2"></i>Agregar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
