@extends('layouts.admin.app')

@section('title', 'Nueva Categor&iacute;a')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold text-cyan neon-glow mb-4"><i class="fas fa-plus me-2"></i>Nueva Categor&iacute;a</h2>
            <form method="POST" action="{{ route('categories.store') }}" class="card card-bg p-4">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label text-light fw-semibold">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-light fw-semibold">Descripci&oacute;n</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient-primary"><i class="fas fa-save me-2"></i>Guardar</button>
                    <a href="{{ route('admin.categories') }}" class="btn btn-outline-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
