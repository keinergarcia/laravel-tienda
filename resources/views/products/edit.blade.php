@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Editar Producto
                    </h3>
                </div>

                <div class="card-body">
                    {{-- Mensajes de error --}}
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

                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Nombre del Producto</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-semibold">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price"
                                           step="0.01" min="0" max="99999999.99"
                                           value="{{ old('price', $product->price) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-semibold">Categoría</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label fw-semibold">URL de Imagen</label>
                                <input type="url" class="form-control" id="image" name="image"
                                       value="{{ old('image', $product->image) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                        </div>

                        {{-- ✅ Campo oculto para evitar error boolean --}}
                        <input type="hidden" name="is_featured" value="0">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Marcar como destacado
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
