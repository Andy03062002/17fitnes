@extends('adminlte::page')

@section('title', 'Generar Rutina IA - Casa Abierta')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Genera tu Rutina IA</h1>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Regresar al Dashboard
        </a>
    </div>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <strong>¡Listo!</strong> {{ session('success') }}
    </div>
@endif

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Formulario para Casa Abierta</h4>
        <small>Completa tus datos para recibir tu rutina personalizada por correo.</small>
    </div>

    <div class="card-body">
        <form action="{{ route('rutinaia.procesar') }}" method="POST">

            @csrf

            <!-- DATOS PERSONALES -->
            <h5 class="text-primary mt-3"><i class="fas fa-user"></i> Datos Personales</h5>
            <div class="row">
                <div class="col-md-4 mt-2">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label>Apellido *</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label>Edad</label>
                    <input type="number" name="edad" class="form-control">
                </div>

                <div class="col-md-6 mt-2">
                    <label>Correo electrónico *</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <div class="col-md-6 mt-2">
                    <label>Ciudad</label>
                    <input type="text" name="ciudad" class="form-control">
                </div>
            </div>

            <!-- DATOS FÍSICOS -->
            <h5 class="text-primary mt-4"><i class="fas fa-dumbbell"></i> Datos Físicos</h5>
            <div class="row">
                <div class="col-md-4 mt-2">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.01" name="peso" class="form-control">
                </div>

                <div class="col-md-4 mt-2">
                    <label>Altura (cm)</label>
                    <input type="number" step="0.01" name="altura" class="form-control">
                </div>

                <div class="col-md-4 mt-2">
                    <label>Nivel de Actividad</label>
                    <select name="nivel_actividad" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Sedentario">Sedentario</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Activo">Activo</option>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Objetivo</label>
                    <select name="objetivo" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Aumentar masa muscular">Aumentar masa muscular</option>
                        <option value="Perder grasa">Perder grasa</option>
                        <option value="Tonificar">Tonificar</option>
                        <option value="Resistencia">Resistencia</option>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Nivel de experiencia</label>
                    <select name="experiencia" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Principiante">Principiante</option>
                        <option value="Intermedio">Intermedio</option>
                        <option value="Avanzado">Avanzado</option>
                    </select>
                </div>
            </div>

            <!-- DISPONIBILIDAD Y PREFERENCIAS -->
            <h5 class="text-primary mt-4"><i class="fas fa-calendar-check"></i> Preferencias de Entrenamiento</h5>
            <div class="row">

                <div class="col-md-6 mt-2">
                    <label>Días disponibles por semana</label>
                    <input type="number" name="dias_disponibles" class="form-control">
                </div>

                <div class="col-md-6 mt-2">
                    <label>Minutos por día</label>
                    <input type="number" name="minutos_por_dia" class="form-control">
                </div>

                <div class="col-md-6 mt-2">
                    <label>Grupo muscular que quieres priorizar</label>
                    <select name="grupo_muscular" class="form-control">
                        <option value="">Seleccione...</option>
                        <option>Pecho</option>
                        <option>Espalda</option>
                        <option>Piernas</option>
                        <option>Hombros</option>
                        <option>Bíceps</option>
                        <option>Tríceps</option>
                        <option>Abdomen</option>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Nivel de dificultad</label>
                    <select name="nivel_dificultad" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Principiante">Principiante</option>
                        <option value="Intermedio">Intermedio</option>
                        <option value="Avanzado">Avanzado</option>
                    </select>
                </div>

            </div>

            <div class="text-center mt-4">
                <button class="btn btn-success btn-lg">
                    <i class="fas fa-paper-plane"></i> Recibir mi Rutina IA
                </button>
            </div>

        </form>
    </div>
</div>

@stop
