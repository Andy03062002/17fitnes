@extends('adminlte::page')

@section('title', 'Nuevo ejercicio')

@section('content_header')
    <h1>Nuevo ejercicio</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.ejercicios.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Grupo muscular</label>
                <input type="text" name="grupo_muscular" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nivel</label>
                <select name="nivel" class="form-control" required>
                    <option value="Principiante">Principiante</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mecánica</label>
                <select name="mecanica" class="form-control" required>
                    <option value="Compuesto">Compuesto</option>
                    <option value="Aislado">Aislado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Video corto (URL)</label>
                <input type="url" name="video_corto" class="form-control">
            </div>

            <button class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>

            <a href="{{ route('admin.ejercicios.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>

    </div>
</div>

@stop
