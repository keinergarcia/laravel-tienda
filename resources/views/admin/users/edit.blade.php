@extends('layouts.admin.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-cyan neon-glow mb-4"><i class="fas fa-user-edit me-2"></i>Editar Usuario</h2>
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="card card-bg p-4">
        @csrf
        @method('PUT')
        @include('admin.users.form', ['user' => $user])
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-gradient-primary">Actualizar</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light">Cancelar</a>
        </div>
    </form>
</div>
@endsection
