@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card card-bg p-3 position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3 opacity-10">
                <i class="fas fa-box fa-3x text-cyan"></i>
            </div>
            <div class="position-relative">
                <p class="text-uppercase fw-semibold mb-1" style="color:#b0b0d0; font-size:0.75rem; letter-spacing:0.05em;">Productos</p>
                <h2 class="mb-0 text-cyan fw-bold">{{ $stats['totalProducts'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-bg p-3 position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3 opacity-10">
                <i class="fas fa-tags fa-3x text-cyan"></i>
            </div>
            <div class="position-relative">
                <p class="text-uppercase fw-semibold mb-1" style="color:#b0b0d0; font-size:0.75rem; letter-spacing:0.05em;">Categor&iacute;as</p>
                <h2 class="mb-0 text-cyan fw-bold">{{ $stats['totalCategories'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-bg p-3 position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3 opacity-10">
                <i class="fas fa-users fa-3x text-cyan"></i>
            </div>
            <div class="position-relative">
                <p class="text-uppercase fw-semibold mb-1" style="color:#b0b0d0; font-size:0.75rem; letter-spacing:0.05em;">Usuarios</p>
                <h2 class="mb-0 text-cyan fw-bold">{{ $stats['totalUsers'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-bg p-3 position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3 opacity-10">
                <i class="fas fa-receipt fa-3x text-cyan"></i>
            </div>
            <div class="position-relative">
                <p class="text-uppercase fw-semibold mb-1" style="color:#b0b0d0; font-size:0.75rem; letter-spacing:0.05em;">Pedidos</p>
                <h2 class="mb-0 text-cyan fw-bold">{{ $stats['totalOrders'] }}</h2>
                @if($stats['pendingOrders'] > 0)
                    <span class="badge bg-warning text-dark mt-1"><i class="fas fa-clock me-1"></i>{{ $stats['pendingOrders'] }} pendiente{{ $stats['pendingOrders'] != 1 ? 's' : '' }}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="card card-bg p-3 d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:rgba(0,255,231,0.1);border:1px solid rgba(0,255,231,0.3);">
                <i class="fas fa-star text-warning fa-lg"></i>
            </div>
            <div>
                <p class="mb-0" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em;">Productos Destacados</p>
                <h4 class="mb-0 text-cyan fw-bold">{{ $stats['featuredProducts'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card card-bg p-3 d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:rgba(0,255,231,0.1);border:1px solid rgba(0,255,231,0.3);">
                <i class="fas fa-check-circle text-success fa-lg"></i>
            </div>
            <div>
                <p class="mb-0" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em;">Pedidos Completados</p>
                <h4 class="mb-0 text-success fw-bold">{{ $stats['totalOrders'] - $stats['pendingOrders'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card card-bg p-3 d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:rgba(255,193,7,0.1);border:1px solid rgba(255,193,7,0.3);">
                <i class="fas fa-exclamation-triangle text-warning fa-lg"></i>
            </div>
            <div>
                <p class="mb-0" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em;">Pendientes</p>
                <h4 class="mb-0 text-warning fw-bold">{{ $stats['pendingOrders'] }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card card-bg">
            <div class="card-header border-bottom border-secondary px-3 py-2 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-cyan"><i class="fas fa-clock me-2"></i>&Uacute;ltimos Pedidos</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-light">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr class="border-bottom border-secondary">
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">ID</th>
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Cliente</th>
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Total</th>
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-3 py-2">{{ $order->id }}</td>
                                    <td class="px-3 py-2 text-light">{{ $order->user->name ?? $order->name }}</td>
                                    <td class="px-3 py-2 fw-bold">${{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-3 py-2">
                                        @if($order->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pendiente</span>
                                        @elseif($order->status === 'completed')
                                            <span class="badge bg-success">Completado</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge bg-danger">Cancelado</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-dark-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block" style="opacity:0.3;"></i>
                                        No hay pedidos recientes
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-bg">
            <div class="card-header border-bottom border-secondary px-3 py-2 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-cyan"><i class="fas fa-box me-2"></i>&Uacute;ltimos Productos</h5>
                <a href="{{ route('admin.products') }}" class="btn btn-sm btn-outline-light">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr class="border-bottom border-secondary">
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Producto</th>
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Categor&iacute;a</th>
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Precio</th>
                                <th class="px-3 py-2" style="color:#b0b0d0; font-size:0.75rem; text-transform:uppercase;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProducts as $product)
                                <tr>
                                    <td class="px-3 py-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $product->image ?: 'https://placehold.co/40x40?text=---' }}" style="width:32px;height:32px;object-fit:cover;border-radius:6px;" alt="">
                                            <span class="text-light fw-semibold">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2"><span class="badge" style="background:#1a1a2e; color:#b0b0d0;">{{ $product->category->name ?? '-' }}</span></td>
                                    <td class="px-3 py-2 fw-bold text-success">${{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-3 py-2">
                                        @if($product->is_featured)
                                            <span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Destacado</span>
                                        @else
                                            <span class="badge" style="background:#1a1a2e; color:#b0b0d0;">Est&aacute;ndar</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-dark-muted">
                                        <i class="fas fa-box-open fa-2x mb-2 d-block" style="opacity:0.3;"></i>
                                        No hay productos registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection