@extends('adminlte::page')

@section('title', 'Editar usuario')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('admin.usuarios.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nueva contraseña (opcional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button class="btn btn-primary mt-3">Guardar cambios</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mt-3">Cancelar</a>

        </form>

    </div>
</div>

@stop
