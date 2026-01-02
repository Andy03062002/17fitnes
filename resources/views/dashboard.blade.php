@extends('adminlte::page')

@section('title', 'Panel 17Fitness')

@section('content_header')
<h1>Bienvenido, {{ Auth::user()->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Rutina IA</h3>
                <p>Genera tu rutina personalizada</p>
            </div>
            <div class="icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <a href="{{ route('rutinaia.generar') }}" class="small-box-footer">
                Ir al módulo <i class="fas fa-arrow-circle-right"></i>
            </a>

        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Historial</h3>
                <p>Revisa tus entrenamientos previos</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">Ver historial <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Perfil</h3>
                <p>Configura tus datos físicos</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="{{ route('perfil.index') }}" class="small-box-footer">Editar perfil <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Que quieres trabajar?</h3>
                <p>Busca ejercicios de acuerdo a tu interes</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="{{ route('entrenar.index') }}" class="small-box-footer">
                Empezar <i class="fas fa-arrow-circle-right"></i>
            </a>

        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg color-primary">
            <div class="inner">
                <h3>Rutina Visitante</h3>
                <p>Genera una rutina corta de prueba</p>
            </div>
            <div class="icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <a href="{{ route('rutinaia.formulario') }}" class="small-box-footer">
                Ir al módulo <i class="fas fa-arrow-circle-right"></i>
            </a>

        </div>
    </div>
</div>
@stop