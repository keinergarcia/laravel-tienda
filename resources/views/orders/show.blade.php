@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-cyan neon-glow mb-0">Pedido #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
        <a href="{{ route('orders.history') }}" class="btn btn-outline-light">Volver</a>
    </div>

    <div class="card bg-dark text-light border-secondary mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>Estado:</strong> {{ $order->status === 'pending' ? 'Pendiente' : 'Completado' }}</p>
            <p class="mb-1"><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p class="mb-0"><strong>Entrega:</strong> {{ $order->address }}, {{ $order->city }}</p>
        </div>
    </div>

    <div class="card bg-dark text-light border-secondary">
        <div class="card-header border-secondary">Productos</div>
        <div class="card-body">
            @foreach($order->items as $item)
                <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-3">
                    <div>
                        <div class="fw-semibold">{{ optional($item->product)->name ?? $item->product_name }}</div>
                        <small class="text-dark-muted">Cantidad: {{ $item->quantity }}</small>
                    </div>
                    <div class="text-success fw-bold">${{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                </div>
            @endforeach

            <div class="mt-3 text-end">
                <div>Subtotal: ${{ number_format($order->subtotal, 0, ',', '.') }}</div>
                <div class="text-success">Descuento: -${{ number_format($order->discount, 0, ',', '.') }}</div>
                <div class="h5 mt-2">Total: ${{ number_format($order->total, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
