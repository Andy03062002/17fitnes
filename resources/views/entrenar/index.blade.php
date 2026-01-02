@extends('adminlte::page')

@section('title', '¿Qué quieres entrenar hoy?')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>¿Qué quieres entrenar hoy?</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar al Dashboard
    </a>
</div>
@stop

@section('content')
<form action="{{ route('entrenar.filtrar') }}" method="POST">
    @csrf

    <div class="row">

        <div class="col-md-4">
            <label>Nivel de intensidad de tu día</label>
            <select name="nivel" class="form-control">
                <option value="">Cualquiera</option>
                <option value="Principiante">Fácil</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Avanzado">Difícil</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Grupo muscular</label>
            <select name="grupo" class="form-control">
                <option value="">Cualquiera</option>
                <option value="Pecho">Pecho</option>
                <option value="Espalda">Espalda</option>
                <option value="Hombros">Hombros</option>
                <option value="Piernas">Piernas</option>
                <option value="BÃ­ceps">Bíceps</option>
                <option value="TrÃ­ceps">Tríceps</option>
                <option value="glÃºteos">Glúteos</option>
                <option value="Abdominales">Abdomen</option>
                <option value="Antebrazos">Antebrazos</option>
                <option value="CuadrÃ­ceps">Cuadriceps</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Mecánica</label>
            <select name="mecanica" class="form-control">
                <option value="">Cualquiera</option>
                <option value="Compuesto">Compuesto</option>
                <option value="Aislamiento">Aislamiento</option>
                <option value="Jalar">Jalar</option>
            </select>
        </div>

    </div>

    <br>

    <button type="submit" class="btn btn-primary btn-lg">
        Filtrar ejercicios
    </button>

</form>
@stop
