@extends('adminlte::page')

@section('title', 'Editar ejercicio')

@section('content_header')
    <h1>Editar ejercicio</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('admin.ejercicios.update', $ejercicio) }}">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $ejercicio->nombre }}" required>
                </div>

                <div class="col-md-6">
                    <label>Grupo muscular</label>
                    <input type="text" name="grupo_muscular" class="form-control" value="{{ $ejercicio->grupo_muscular }}" required>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Nivel</label>
                    <select name="nivel" class="form-control">
                        <option {{ $ejercicio->nivel=='Principiante'?'selected':'' }}>Principiante</option>
                        <option {{ $ejercicio->nivel=='Intermedio'?'selected':'' }}>Intermedio</option>
                        <option {{ $ejercicio->nivel=='Avanzado'?'selected':'' }}>Avanzado</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Mecánica</label>
                    <select name="mecanica" class="form-control">
                        <option {{ $ejercicio->mecanica=='Compuesto'?'selected':'' }}>Compuesto</option>
                        <option {{ $ejercicio->mecanica=='Aislado'?'selected':'' }}>Aislado</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Video corto (URL)</label>
                    <input type="text" name="video_corto" class="form-control" value="{{ $ejercicio->video_corto }}">
                </div>

            </div>

            <button class="btn btn-primary mt-4">
                Guardar cambios
            </button>

            <a href="{{ route('admin.ejercicios.index') }}" class="btn btn-secondary mt-4">
                Cancelar
            </a>

        </form>

    </div>
</div>

@stop
