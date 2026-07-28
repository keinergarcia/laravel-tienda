@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">
        <i class="fas fa-plus me-2"></i>Crear Nuevo Producto
    </h2>

    {{-- Mensajes de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Corrige los siguientes errores:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de creación --}}
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" max="99999999.99" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">URL de la Imagen</label>
            <input type="url" id="image" name="image" class="form-control" value="{{ old('image') }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select id="category_id" name="category_id" class="form-select" required>
                <option value="">-- Selecciona una categoría --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Campo oculto para enviar "false" si el checkbox no está marcado --}}
        <input type="hidden" name="is_featured" value="0">
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">
                Marcar como destacado
            </label>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Volver
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Guardar Producto
            </button>
        </div>
    </form>
</div>
@endsection
