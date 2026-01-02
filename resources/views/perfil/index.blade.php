@extends('adminlte::page')

@section('title', 'Perfil Físico')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Mi Perfil Físico</h1>

        <a href="{{ route('dashboard') }}" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Regresar al Dashboard
        </a>
    </div>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('perfil.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-3">
                    <label>Edad</label>
                    <input type="number" name="edad" value="{{ $perfil->edad ?? '' }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.01" name="peso" value="{{ $perfil->peso ?? '' }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Altura (cm)</label>
                    <input type="number" step="0.01" name="altura" value="{{ $perfil->altura ?? '' }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Género</label>
                    <select name="genero" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Masculino" {{ ($perfil->genero ?? '')=='Masculino'?'selected':'' }}>Masculino</option>
                        <option value="Femenino" {{ ($perfil->genero ?? '')=='Femenino'?'selected':'' }}>Femenino</option>
                        <option value="Otro" {{ ($perfil->genero ?? '')=='Otro'?'selected':'' }}>Otro</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Somatotipo</label>
                    <select name="somatotipo" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Ectomorfo" {{ ($perfil->somatotipo ?? '')=='Ectomorfo'?'selected':'' }}>Ectomorfo</option>
                        <option value="Mesomorfo" {{ ($perfil->somatotipo ?? '')=='Mesomorfo'?'selected':'' }}>Mesomorfo</option>
                        <option value="Endomorfo" {{ ($perfil->somatotipo ?? '')=='Endomorfo'?'selected':'' }}>Endomorfo</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Nivel de Actividad</label>
                    <select name="nivel_actividad" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Sedentario" {{ ($perfil->nivel_actividad ?? '')=='Sedentario'?'selected':'' }}>Sedentario</option>
                        <option value="Moderado" {{ ($perfil->nivel_actividad ?? '')=='Moderado'?'selected':'' }}>Moderado</option>
                        <option value="Activo" {{ ($perfil->nivel_actividad ?? '')=='Activo'?'selected':'' }}>Activo</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Objetivo</label>
                    <select name="objetivo" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Aumentar masa muscular" {{ ($perfil->objetivo ?? '')=='Aumentar masa muscular'?'selected':'' }}>Aumentar masa muscular</option>
                        <option value="Perder grasa" {{ ($perfil->objetivo ?? '')=='Perder grasa'?'selected':'' }}>Perder grasa</option>
                        <option value="Tonificar" {{ ($perfil->objetivo ?? '')=='Tonificar'?'selected':'' }}>Tonificar</option>
                        <option value="Resistencia" {{ ($perfil->objetivo ?? '')=='Resistencia'?'selected':'' }}>Resistencia</option>
                    </select>
                </div>

                <div class="col-md-6 mt-3">
                    <label>Días disponibles a la semana</label>
                    <input type="number" name="disponibilidad_dias" value="{{ $perfil->disponibilidad_dias ?? '' }}" class="form-control">
                </div>

                <div class="col-md-6 mt-3">
                    <label>Minutos por día</label>
                    <input type="number" name="minutos_por_dia" value="{{ $perfil->minutos_por_dia ?? '' }}" class="form-control">
                </div>

                <div class="col-md-12 mt-3">
                    <label>Lesiones</label>
                    <textarea name="lesiones" class="form-control" rows="2">{{ $perfil->lesiones ?? '' }}</textarea>
                </div>

                <div class="col-md-12 mt-3">
                    <label>Nivel de Experiencia</label>
                    <select name="experiencia" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Principiante" {{ ($perfil->experiencia ?? '')=='Principiante'?'selected':'' }}>Principiante</option>
                        <option value="Intermedio" {{ ($perfil->experiencia ?? '')=='Intermedio'?'selected':'' }}>Intermedio</option>
                        <option value="Avanzado" {{ ($perfil->experiencia ?? '')=='Avanzado'?'selected':'' }}>Avanzado</option>
                    </select>
                </div>

            </div>

            <button class="btn btn-primary mt-4">Guardar Perfil</button>
        </form>

    </div>
</div>

@stop
