@extends('adminlte::page')

@section('title', 'Tu Rutina IA')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Tu Rutina Generada</h1>

    <a href="{{ route('rutinaia.formulario') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar al Dashboard
    </a>
</div>
@stop

@section('content')

{{-- MENSAJE DE EXITO --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">

    {{-- COLUMNA IZQUIERDA (Rutina generada) --}}
    <div class="col-md-8">
        
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Rutina generada por IA</h4>
            </div>

            <div class="card-body">

                {{-- AQUI SE MUESTRA LA RUTINA EN HTML BONITO --}}
                <div style="font-size: 16px; line-height: 1.6;">
                    {!! $rutina_html !!}
                </div>

            </div>
        </div>

        {{-- BOTÓN PARA ENVIAR PDF --}}
        <form action="{{ route('rutinaia.enviar') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Enviar esta rutina por correo (PDF)
            </button>
        </form>

    </div>

    {{-- COLUMNA DERECHA (Resumen del usuario) --}}
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Resumen del usuario</h5>
            </div>

            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $json['datos_personales']['nombre'] }} {{ $json['datos_personales']['apellido'] }}</p>
                <p><strong>Edad:</strong> {{ $json['datos_personales']['edad'] }}</p>
                <p><strong>Objetivo:</strong> {{ $json['datos_fisicos']['objetivo'] }}</p>
                <p><strong>Días disponibles:</strong> {{ $json['preferencias']['dias_disponibles'] }}</p>
                <p><strong>Minutos por día:</strong> {{ $json['preferencias']['minutos_por_dia'] }}</p>
            </div>
        </div>
    </div>

</div>

@stop
