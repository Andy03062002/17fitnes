@extends('adminlte::page')

@section('title', 'Tu Rutina IA')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Tu Rutina Generada</h1>

    <a href="{{ route('dashboard') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar al Dashboard
    </a>
</div>
@stop

@section('content')

@php
    $json = session('rutina_json');    // Datos enviados a la IA
    $prompt = session('prompt');       // Prompt final
    $rutina = session('rutinaia');     // Respuesta de Anthropic
@endphp

@if (!$json || !$rutina)
    <div class="alert alert-danger">
        No se encontraron datos. Vuelve a completar el formulario.
    </div>
@else

    {{-- DATOS ENVIADOS --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Datos enviados al modelo IA</h4>
        </div>

        <div class="card-body">
            <pre>{{ json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
    </div>

    {{-- PROMPT GENERADO --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Prompt utilizado</h4>
        </div>

        <div class="card-body">
            <pre>{{ $prompt }}</pre>
        </div>
    </div>

    {{-- RESPUESTA DE LA IA --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Rutina generada por IA</h4>
        </div>

        <div class="card-body">

            @if($rutina['success'] === true)
                @php
                    // El texto generado por la IA viene en:
                    // $rutina['data']['content'][0]['text']
                    $texto = $rutina['data']['content'][0]['text'] ?? 'Sin contenido';
                @endphp

                <div class="alert alert-success">
                    <strong>Resultado IA:</strong>
                </div>

                <pre style="white-space: pre-wrap;">{{ $texto }}</pre>
            @else
                <div class="alert alert-danger">
                    <strong>Error en la IA:</strong>  
                    {{ $rutina['error'] ?? 'Error desconocido' }}
                </div>
            @endif

        </div>
    </div>

@endif

@stop
