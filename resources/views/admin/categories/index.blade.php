@extends('layouts.admin.app')

@section('title', 'Gesti&oacute;n de Categor&iacute;as')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-cyan neon-glow mb-4">
        <i class="fas fa-cogs me-2"></i>Gesti&oacute;n de Categor&iacute;as
    </h2>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <div class="alert alert-success bg-success text-white border-0 shadow-sm">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger bg-danger text-white border-0 shadow-sm">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    {{-- Formulario de nueva categor&iacute;a --}}
    <div class="card card-bg mb-4">
        <div class="card-header border-bottom border-secondary">
            <h5 class="mb-0 text-cyan">
                <i class="fas fa-plus-circle me-2"></i>Agregar Nueva Categor&iacute;a
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="name" class="form-label text-light">Nombre</label>
                        <input type="text" name="name" id="name"
                               class="form-control bg-dark text-light border-secondary" required>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label text-light">Descripci&oacute;n</label>
                        <input type="text" name="description" id="description"
                               class="form-control bg-dark text-light border-secondary">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-gradient-primary w-100">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de categor&iacute;as --}}
    <div class="card card-bg shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover border-secondary align-middle mb-0">
                    <thead class="text-cyan border-bottom border-secondary">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-light">{{ $category->name }}</td>
                                <td class="text-muted">{{ $category->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('&iquest;Eliminar esta categor&iacute;a?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-dark-muted py-3">
                                    <i class="fas fa-box-open me-2"></i>No hay categor&iacute;as registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
