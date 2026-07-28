@extends('layouts.admin.app')

@section('title', 'Nuevo Usuario')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-cyan neon-glow mb-4"><i class="fas fa-user-plus me-2"></i>Nuevo Usuario</h2>
    <form method="POST" action="{{ route('admin.users.store') }}" class="card card-bg p-4">
        @csrf
        @include('admin.users.form', ['user' => null])
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-gradient-primary">Guardar</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light">Cancelar</a>
        </div>
    </form>
</div>
@endsection
