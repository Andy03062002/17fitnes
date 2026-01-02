@extends('adminlte::page')

@section('title', 'Rutina IA Visitante')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Generar Rutina IA (Visitante)</h1>

    <a href="{{ route('dashboard') }}" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Regresar al Dashboard
        </a>
</div>
@stop

@section('content')

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Ingresa tus datos</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('rutinaia.procesar') }}" method="POST">
            @csrf

            <h5 class="text-primary">Datos personales</h5>
            <div class="row">
                <div class="col-md-6">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Apellido:</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <label>Edad:</label>
                    <input type="number" name="edad" class="form-control">
                </div>
                <div class="col-md-8">
                    <label>Correo:</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
            </div>

            <hr>

            <h5 class="text-primary">Datos físicos</h5>
            <div class="row">
                <div class="col-md-4">
                    <label>Peso (kg):</label>
                    <input type="number" step="0.1" name="peso" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Altura (cm):</label>
                    <input type="number" step="0.1" name="altura" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Nivel de actividad:</label>
                    <select name="nivel_actividad" class="form-control">
                        <option>Sedentario</option>
                        <option>Moderado</option>
                        <option>Activo</option>
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <label>Objetivo:</label>
                    <select name="objetivo" class="form-control">
                        <option>Aumentar masa muscular</option>
                        <option>Perder grasa</option>
                        <option>Tonificar</option>
                        <option>Resistencia</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Experiencia:</label>
                    <select name="experiencia" class="form-control">
                        <option>Principiante</option>
                        <option>Intermedio</option>
                        <option>Avanzado</option>
                    </select>
                </div>
            </div>

            <hr>

            <h5 class="text-primary">Preferencias</h5>

            <div class="row">
                <div class="col-md-4">
                    <label>Días disponibles:</label>
                    <input type="number" name="dias_disponibles" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Minutos por día:</label>
                    <input type="number" name="minutos_por_dia" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Grupo muscular preferido:</label>
                    <input type="text" name="grupo_muscular" class="form-control">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <label>Nivel de dificultad:</label>
                    <select name="nivel_dificultad" class="form-control">
                        <option>Fácil</option>
                        <option>Intermedio</option>
                        <option>Difícil</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-success mt-3">Recibir mi rutina IA</button>

        </form>

    </div>
</div>

@stop
