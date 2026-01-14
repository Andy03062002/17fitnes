@extends('adminlte::page')

@section('title', 'Ejercicios')

@section('content_header')
    <h1>Gestión de Ejercicios</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de ejercicios</h3>

        <div class="card-tools">
            <a href="{{ route('admin.ejercicios.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo ejercicio
            </a>
        </div>
    </div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table id="ejerciciosTable" class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Grupo muscular</th>
                    <th>Nivel</th>
                    <th>Mecánica</th>
                    <th>Video</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ejercicios as $ejercicio)
                <tr>
                    <td>{{ $ejercicio->id }}</td>
                    <td>{{ $ejercicio->nombre }}</td>
                    <td>{{ $ejercicio->grupo_muscular }}</td>
                    <td>{{ $ejercicio->nivel }}</td>
                    <td>{{ $ejercicio->mecanica }}</td>
                    <td>
                        @if($ejercicio->video_corto)
                            <a href="{{ $ejercicio->video_corto }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-video"></i>
                            </a>
                        @else
                            <span class="text-muted">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.ejercicios.edit', $ejercicio) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.ejercicios.destroy', $ejercicio) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('¿Eliminar este ejercicio?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#ejerciciosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            "pageLength": 10,        // cantidad de registros por página
            "lengthChange": false,   // oculta el selector de "mostrar X registros"
            "ordering": true,
            "responsive": true,
            "dom": '<"top"f>rt<"bottom"p><"clear">' 
            // f = buscador arriba, p = paginación abajo
        });
    });
</script>
@stop