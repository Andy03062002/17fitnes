@extends('adminlte::page')

@section('title', 'Rutina IA')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
<h1>{{ $rutina->nombre }}</h1>

<a href="{{ route('dashboard') }}" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Regresar al Dashboard
        </a>
</div>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! $htmlRutina !!}
    </div>
</div>

<a href="{{ route('rutina.historial') }}" class="btn btn-secondary">
    Volver al Historial
</a>

@stop

