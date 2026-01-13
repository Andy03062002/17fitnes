@extends('adminlte::page')

@section('title', 'Resultados')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Ejercicios recomendados</h1>

    <a href="{{ route('entrenar.index') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
</div>
@stop

@section('content')
<div class="row">

    @forelse($ejercicios as $e)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{ $e->nombre }}
                </div>
                <div class="card-body">
                    <p><strong>Grupo muscular:</strong> {{ $e->grupo_muscular_objetivo }}</p>
                    <p><strong>Nivel:</strong> {{ $e->nivel_dificultad }}</p>
                    <p><strong>Mecánica:</strong> {{ $e->mecanica }}</p>

                    @if($e->video_corto)
                        <a href="{{ $e->video_corto }}" target="_blank" class="btn btn-sm btn-dark">
                            Ver video corto
                        </a>
                    @endif

                    @if($e->video_detallado)
                        <a href="{{ $e->video_detallado }}" target="_blank" class="btn btn-sm btn-secondary">
                            Ver video detallado
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-danger">No se encontraron ejercicios con esos filtros.</p>
    @endforelse

</div>
@stop
