@extends('layouts.app')

@section('title', 'Historial de Pedidos')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold text-cyan neon-glow mb-4">
                <i class="fas fa-history me-2"></i>Historial de Pedidos
            </h2>

            @if ($orders->isEmpty())
                <div class="text-center py-5 bg-dark text-light rounded">
                    <i class="fas fa-shopping-bag fa-4x text-neon mb-3"></i>
                    <h4 class="text-neon">No tienes pedidos aún</h4>
                    <p class="text-neon mb-4">¡Explora nuestros productos y realiza tu primera compra!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-gradient-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Ir a Productos
                    </a>
                </div>
            @else
                @foreach ($orders as $order)
                    <div class="card shadow-sm mb-4 border-0 bg-dark text-light">
                        <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center text-white">
                            <div>
                                <h5 class="mb-0 fw-bold text-neon">Pedido #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                <small class="text-light">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : 'success' }} fs-6">
                                {{ $order->status === 'pending' ? 'Pendiente' : 'Completado' }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="fw-bold mb-3 text-neon">Productos:</h6>
                                    @foreach ($order->items as $item)
                                        <div class="d-flex align-items-center mb-3 bg-secondary bg-opacity-10 rounded p-2">
                                            <img src="{{ optional($item->product)->image ?: 'https://placehold.co/120x120?text=Producto' }}" 
                                                 class="rounded me-3" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-light">{{ optional($item->product)->name ?? $item->product_name }}</h6>
                                                <small class="text-dark-muted">Cantidad: {{ $item->quantity }}</small>
                                            </div>
                                            <span class="fw-semibold text-success">
                                                ${{ number_format($item->price * 0.9 * $item->quantity, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-dark border border-secondary p-3 rounded">
<div class="d-flex justify-content-between mb-1">
                                        <span class="text-dark-muted">Subtotal:</span>
                                        <span class="text-light">${{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                        <div class="d-flex justify-content-between mb-1 text-success">
                                            <span>Descuento:</span>
                                            <span>-${{ number_format($order->discount, 0, ',', '.') }}</span>
                                        </div>
                                        <hr class="my-2 border-secondary">
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total:</span>
                                            <span class="text-success">${{ number_format($order->total, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
