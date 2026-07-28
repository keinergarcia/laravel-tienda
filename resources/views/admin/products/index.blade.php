@extends('layouts.admin.app')
@section('title', 'Administrar Productos')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-cyan neon-glow mb-0"><i class="fas fa-boxes me-2"></i>Productos</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('products.create') }}" class="btn btn-gradient-primary"><i class="fas fa-plus me-2"></i>Nuevo Producto</a>
        </div>
    </div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    <div class="card card-bg mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.search') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="q" class="form-control bg-dark text-light border-secondary" placeholder="Buscar producto por nombre..." value="{{ request('q') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-gradient-primary w-100"><i class="fas fa-search me-2"></i>Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card card-bg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead><tr><th>Imagen</th><th>Nombre</th><th>Categor&iacute;a</th><th>Precio</th><th>Destacado</th><th class="text-end">Acciones</th></tr></thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td><img src="{{ $product->image ?: 'https://placehold.co/50x50?text=No+Image' }}" style="width:50px;height:50px;object-fit:cover;border-radius:8px;" alt=""></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Sin categor&iacute;a' }}</td>
                                <td>${{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{!! $product->is_featured ? '<span class="badge bg-warning text-dark"><i class="fas fa-star"></i></span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
                                <td class="text-end">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="d-inline" onsubmit="return confirm('&iquest;Eliminar este producto?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-dark-muted">No hay productos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection