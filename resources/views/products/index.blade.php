@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-cyan neon-glow mb-4">
        <i class="fas fa-box me-2"></i>Todos los Productos
    </h2>

    {{-- Mostrar término buscado (opcional) --}}
    @if (!empty($search))
        <p class="text-info mb-3">Resultados para: <strong>{{ $search }}</strong></p>
    @endif

    {{-- Botón para crear producto (solo para admin) --}}
    @auth
        @if(Auth::user()->isAdmin())
            <div class="mb-4 text-end">
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Crear Producto
                </a>
            </div>
        @endif
    @endauth

    <div class="row">
        @forelse ($products as $product)
            @php
                $discountedPrice = $product->price * 0.9;
                $savings = $product->price - $discountedPrice;
            @endphp
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow border-0 bg-dark text-light fade-in-up">
                    <div class="position-relative">
                        <img src="{{ $product->image ?: 'https://placehold.co/400x300?text=Producto' }}"
                             class="card-img-top rounded-top"
                             alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover; box-shadow: 0 0 8px rgba(0, 255, 255, 0.15);">

                        @if ($product->is_featured)
                            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 fw-semibold shadow">
                                <i class="fas fa-star me-1"></i>Destacado
                            </span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-white neon-glow">{{ $product->name }}</h5>
                        
                        <p class="text-light small" style="opacity: 0.85;">
                            {{ Str::limit($product->description, 60) }}
                        </p>

                        <div class="mb-2">
                            <span class="h6 text-success fw-bold me-2">
                                ${{ number_format($discountedPrice, 0, ',', '.') }}
                            </span>
                            <span class="text-muted text-decoration-line-through small">
                                ${{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('cart.add') }}" class="mb-2 mt-auto">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-gradient-primary w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Agregar al Carrito
                            </button>
                        </form>

                        @auth
                            @if(Auth::user()->isAdmin())
                                <div class="d-flex justify-content-between mt-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-outline-warning w-50 me-1 d-flex justify-content-center align-items-center py-2">
                                        <i class="fas fa-edit fs-5"></i>
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este producto?')"
                                          class="w-50">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100 d-flex justify-content-center align-items-center py-2">
                                            <i class="fas fa-trash fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
           <div class="col-12 text-center">
<p class="text-white fw-bold" style="text-shadow: 0 0 6px cyan;">No hay productos disponibles.</p>

</div>

        @endforelse
    </div>
</div>
@endsection
