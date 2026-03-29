@extends('adminlte::page')

@section('title', 'Historial de Rutinas')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Historial de Rutinas</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar al Dashboard
    </a>
</div>
@stop

@section('content')

<div class="card">
    <div class="card-body table-responsive">
        <table id="rutinasTable" class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Generada Por</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rutinas as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->nombre }}</td>
                    <td>{{ $r->generada_por }}</td>
                    <td>{{ $r->fecha_generacion }}</td>
                    <td>
                        <a href="{{ route('rutina.ver', $r->id) }}" class="btn btn-sm btn-primary">Ver</a>
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
        $('#rutinasTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            "pageLength": 10,        // registros por página
            "lengthChange": false,   // oculta el selector de cantidad
            "ordering": true,
            "responsive": true,
            "dom": '<"top"f>rt<"bottom"p><"clear">' 
            // f = buscador arriba, p = paginación abajo
        });
    });
</script>
@stop