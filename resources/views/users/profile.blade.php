@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        {{-- Panel de información del usuario --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm bg-dark text-light border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle fa-5x text-cyan neon-glow"></i>
                    </div>
                    <h4 class="fw-bold text-white neon-glow">{{ $user->name }}</h4>
                    <p class="text-dark-muted">{{ '@' . \Illuminate\Support\Str::slug($user->name) }}</p>
                    <p class="text-dark-muted">{{ $user->email }}</p>

                    @if ($user->role === 'admin')
                        <span class="badge bg-danger fs-6">Administrador</span>
                    @else
                        <span class="badge bg-primary fs-6">Cliente</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Panel de estadísticas y pedidos --}}
        <div class="col-lg-8">
            {{-- Estadísticas --}}
            <div class="card shadow-sm bg-dark text-light border-0 mb-4">
                <div class="card-header border-0 bg-dark">
                    <h5 class="mb-0 text-cyan neon-glow">
                        <i class="fas fa-chart-bar me-2"></i>Estadísticas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 border-end border-secondary">
                            <h3 class="text-cyan fw-bold">{{ $orders->count() }}</h3>
                            <p class="text-light mb-0">Pedidos Realizados</p>
                        </div>
                        <div class="col-md-4 border-end border-secondary">
                            <h3 class="text-success fw-bold">
                                ${{ number_format($orders->sum('total'), 0, ',', '.') }}
                            </h3>
                            <p class="text-light mb-0">Total Gastado</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-warning fw-bold">
                                ${{ number_format($orders->sum('discount'), 0, ',', '.') }}
                            </h3>
                            <p class="text-light mb-0">Total Ahorrado</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Últimos pedidos --}}
            <div class="card shadow-sm bg-dark text-light border-0">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark border-0">
                    <h5 class="mb-0 text-cyan neon-glow">
                        <i class="fas fa-history me-2"></i>Últimos Pedidos
                    </h5>
                    <a href="{{ route('orders.history') }}" class="btn btn-sm btn-outline-light">
                        Ver Todos
                    </a>
                </div>
                <div class="card-body">
                    @if ($orders->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-bag fa-3x text-neon mb-3"></i>
                            <p class="text-dark-muted">No tienes pedidos aún</p>
                            <a href="{{ route('products.index') }}" class="btn btn-gradient-primary">
                                <i class="fas fa-shopping-cart me-2"></i>Empezar a Comprar
                            </a>
                        </div>
                    @else
                        @foreach ($orders->take(3) as $order)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                <div>
                                    <h6 class="mb-0 text-white">Pedido #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h6>
                                    <small class="text-dark-muted">{{ $order->created_at->format('d/m/Y') }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold text-success">
                                        ${{ number_format($order->total, 0, ',', '.') }}
                                    </span>
                                    <br>
                                    <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                                        {{ $order->status === 'pending' ? 'Pendiente' : 'Completado' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
