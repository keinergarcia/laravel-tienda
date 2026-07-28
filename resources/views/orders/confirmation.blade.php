@extends('layouts.app')

@section('title', 'Confirmación de Pedido')

@section('content')
<div class="container py-5 fade-in-up">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 text-center bg-dark text-white">
                <div class="card-header bg-success border-0 rounded-top">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-check-circle me-2"></i>¡Pedido Confirmado!
                    </h4>
                </div>
                <div class="card-body">
                    <p class="fs-5 mb-4">
                        Gracias por tu compra. Tu pedido 
                        <span class="fw-bold text-success">#{{ $orderId }}</span> 
                        ha sido recibido correctamente.
                    </p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('orders.history') }}" class="btn btn-outline-light px-4 py-2">
                            <i class="fas fa-history me-2"></i>Ver Historial
                        </a>

                        <a href="{{ route('products.index') }}" class="btn btn-gradient-primary px-4 py-2">
                            <i class="fas fa-store me-2"></i>Seguir Comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
