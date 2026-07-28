@extends('layouts.admin.app')
@section('title', 'Resultados de B&uacute;squeda')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-cyan neon-glow mb-0"><i class="fas fa-search me-2"></i>Resultados: {{ $query }}</h2>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-light"><i class="fas fa-arrow-left me-2"></i>Volver</a>
    </div>
    <div class="card card-bg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead><tr><th>Nombre</th><th>Categor&iacute;a</th><th>Precio</th><th class="text-end">Acciones</th></tr></thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Sin categor&iacute;a' }}</td>
                                <td>${{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="d-inline" onsubmit="return confirm('&iquest;Eliminar?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($products->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-search fa-4x text-dark-muted mb-3"></i>
            <h4 class="text-dark-muted">No se encontraron productos</h4>
        </div>
    @endif
</div>
@endsection