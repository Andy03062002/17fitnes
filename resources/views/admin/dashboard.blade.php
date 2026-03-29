@extends('adminlte::page')

@section('title', 'Administrar')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Administración del sistema</h1>

    <a href="{{ route('dashboard') }}" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Regresar al Dashboard
        </a>

</div>
@stop

@section('content')

<div class="row">

    {{-- USUARIOS --}}
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Usuarios</h3>
                <p>Gestionar usuarios registrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">
                Administrar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- EJERCICIOS --}}
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Ejercicios</h3>
                <p>Catálogo de ejercicios</p>
            </div>
            <div class="icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <a href="{{ route('admin.ejercicios.index') }}" class="small-box-footer">
                Administrar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- FUTURO --}}
    <div class="col-lg-4 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Próximamente</h3>
                <p>Nuevos módulos</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <span class="small-box-footer text-muted">
                En desarrollo
            </span>
        </div>
    </div>

</div>

@stop
