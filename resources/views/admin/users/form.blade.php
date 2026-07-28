<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" id="name" value="{{ old('name', optional($user)->name) }}" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email', optional($user)->email) }}" class="form-control @error('email') is-invalid @enderror" required>
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="role" class="form-label">Rol</label>
    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
        <option value="cliente" @selected(old('role', optional($user)->role ?? 'cliente') === 'cliente')>Cliente</option>
        <option value="admin" @selected(old('role', optional($user)->role) === 'admin')>Admin</option>
    </select>
    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Contraseña {{ $user ? '(dejar vacía para no cambiar)' : '' }}</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" {{ $user ? '' : 'required' }}>
    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ $user ? '' : 'required' }}>
</div>
