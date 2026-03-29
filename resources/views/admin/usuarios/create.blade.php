@extends('adminlte::page')

@section('title', 'Crear usuario')

@section('content_header')
<h1>Crear usuario</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('admin.usuarios.store') }}">
            @csrf

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                Crear usuario
                </button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mt-3">Cancelar</a>

        </form>

    </div>
</div>

@stop