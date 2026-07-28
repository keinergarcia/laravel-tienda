@extends('layouts.admin.app')

@section('title', 'Gesti&oacute;n de Usuarios')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-cyan neon-glow mb-0"><i class="fas fa-users me-2"></i>Usuarios</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-gradient-primary">Nuevo Usuario</a>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <div class="card card-bg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead><tr><th>Nombre</th><th>Email</th><th>Rol</th><th class="text-end">Acciones</th></tr></thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-{{ $user->isAdmin() ? 'info' : 'secondary' }}">{{ $user->role }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline" onsubmit="return confirm('&iquest;Eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-dark-muted">No hay usuarios registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
