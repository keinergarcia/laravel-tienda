@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold text-cyan neon-glow mb-4 d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-tags me-2"></i>Categorías
                </span>

                @auth
                    @if(Auth::user()->isAdmin())
                        <div class="d-flex gap-2">

                            <a href="{{ route('admin.categories') }}" class="btn btn-outline-info">
                                <i class="fas fa-cogs me-1"></i>Administrar Categorías
                            </a>
                        </div>
                    @endif
                @endauth
            </h2>

            <!-- Búsqueda -->
            <div class="card shadow-sm mb-4 border-0 bg-dark text-light">
                <div class="card-body">
                    <form method="GET" action="{{ route('categories.index') }}" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-neon border-secondary">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control bg-dark text-light border-secondary" name="search"
                                       placeholder="Buscar productos por nombre..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <select name="category" class="form-select bg-dark text-light border-secondary">
                                <option value="">Todas las categorías</option>
                                @foreach ($categoryCounts as $cat => $count)
                                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                        {{ $cat }} ({{ $count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-gradient-primary w-100">
                                <i class="fas fa-search me-1"></i>Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Resumen de categorías -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-gradient-primary text-white h-100 {{ request('category') == '' ? 'border-warning border-3' : '' }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Todas</h5>
                                    <p class="card-text">Ver todos los productos</p>
                                </div>
                                <i class="fas fa-box fa-2x opacity-75"></i>
                            </div>
                            <div class="mt-3">
                                <span class="h3 fw-bold">{{ collect($categoryCounts)->sum() }}</span>
                                <span class="ms-1">productos</span>
                            </div>
                            <a href="{{ route('categories.index') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                @foreach ($categoryCounts as $category => $count)
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card bg-dark text-light h-100 {{ request('category') === $category ? 'border-warning border-3' : '' }}">
                            <div class="card-body position-relative">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title text-neon">{{ $category }}</h5>
                                        <p class="card-text text-muted">Ver productos</p>
                                    </div>
                                    <i class="fas fa-tag fa-2x text-neon"></i>
                                </div>
                                <div class="mt-3">
                                    <span class="h3 fw-bold text-neon">{{ $count }}</span>
                                    <span class="text-muted ms-1">productos</span>
                                </div>
                                <a href="{{ route('categories.index', ['category' => $category]) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (request('category'))
                <h3 class="fw-bold text-cyan mb-3 neon-glow">Productos en {{ request('category') }}</h3>
            @endif

            <div class="row">
                @if ($filteredProducts->isEmpty())
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-search fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No se encontraron productos</h4>
                        <p class="text-muted">
                            {{ request('search') ? 'Intenta con otro término de búsqueda' : 'No hay productos en esta categoría' }}
                        </p>
                    </div>
                @else
                    @foreach ($filteredProducts as $product)
                        @php
                            $discountedPrice = $product->price * 0.9;
                            $savings = $product->price - $discountedPrice;
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm border-0 bg-dark text-light fade-in-up">
                                <div class="position-relative">
                                    <img src="{{ $product->image ?: 'https://placehold.co/400x300?text=Producto' }}"
                                         class="card-img-top rounded-top"
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                    <span class="badge bg-warning position-absolute top-0 end-0 m-2">
                                        <i class="fas fa-tag me-1"></i>10% OFF
                                    </span>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-neon text-truncate">{{ $product->name }}</h5>
                                        <span class="badge bg-secondary">{{ $product->category->name ?? 'Sin categoría' }}</span>
                                    </div>

                                    {{-- Descripción del producto --}}
                                    <p class="text-muted small mb-2">{{ Str::limit($product->description, 80) }}</p>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="h4 text-success fw-bold me-2">${{ number_format($discountedPrice, 0, ',', '.') }}</span>
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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
