@extends('layouts.admin.app')

@section('title', 'Editar Categor&iacute;a')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="fw-bold text-cyan neon-glow mb-4"><i class="fas fa-edit me-2"></i>Editar Categor&iacute;a</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('categories.update', $category->id) }}" class="card card-bg p-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label text-light fw-semibold">Nombre de la Categor&iacute;a</label>
                    <input type="text"
                           class="form-control bg-dark text-light border-secondary @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name', $category->name) }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label text-light fw-semibold">Descripci&oacute;n</label>
                    <textarea class="form-control bg-dark text-light border-secondary @error('description') is-invalid @enderror"
                              id="description"
                              name="description"
                              rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.categories') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-gradient-primary">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
