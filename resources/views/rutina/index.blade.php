@extends('adminlte::page')

@section('title', 'Rutina IA')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Rutina IA</h1>

    <a href="{{ route('dashboard') }}" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Regresar al Dashboard
        </a>
</div>
@stop

@section('content')

{{-- Mensajes --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">

    {{-- CARD PRINCIPAL --}}
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-robot"></i> Generador de Rutinas con IA
                </h3>
            </div>

            <div class="card-body">
                <p>
                    La inteligencia artificial generará una <strong>rutina personalizada</strong>
                    basada en tu perfil físico, objetivos y disponibilidad.
                </p>

                <ul>
                    <li>✔ Nivel de experiencia</li>
                    <li>✔ Objetivo fitness</li>
                    <li>✔ Días disponibles</li>
                    <li>✔ Minutos por día</li>
                    <li>✔ Lesiones (si aplica)</li>
                </ul>

                <form action="{{ route('rutina.generar') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-lg">
                        <i class="fas fa-dumbbell"></i> Generar mi rutina
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- CARD PERFIL --}}
    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user"></i> Estado de tu perfil
                </h3>
            </div>

            <div class="card-body">

                @php
                    $perfil = \App\Models\PerfilUsuario::where('user_id', auth()->id())->first();
                @endphp

                @if(!$perfil)
                    <div class="alert alert-warning">
                        ⚠️ Aún no has completado tu perfil.
                    </div>

                    <a href="{{ route('perfil.index') }}" class="btn btn-warning btn-block">
                        Completar perfil
                    </a>
                @else
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Objetivo:</strong> {{ $perfil->objetivo ?? '—' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Experiencia:</strong> {{ $perfil->experiencia ?? '—' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Días/semana:</strong> {{ $perfil->disponibilidad_dias ?? '—' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Minutos/día:</strong> {{ $perfil->minutos_por_dia ?? '—' }}
                        </li>
                    </ul>

                    <a href="{{ route('perfil.index') }}" class="btn btn-secondary btn-block mt-3">
                        Editar perfil
                    </a>
                @endif

            </div>
        </div>
    </div>

</div>

@stop
