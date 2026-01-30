@extends('adminlte::page')

@section('title', 'Ejercicios')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Gestión de Ejercicios</h1>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
    <a href="{{ route('admin.ejercicios.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nuevo Ejercicio
    </a>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="ejerciciosTable" class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
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
                    @forelse($ejercicios as $ejercicio)
                                    <tr>
                                        <td>{{ $ejercicio->id }}</td>
                                        <td>{{ $ejercicio->nombre }}</td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $ejercicio->grupo_muscular_objetivo }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ 
                                                                                                        $ejercicio->nivel_dificultad == 'Principiante' ? 'success' :
                        ($ejercicio->nivel_dificultad == 'Intermedio' ? 'warning' : 'danger') 
                                                                                                    }}">
                                                {{ $ejercicio->nivel_dificultad }}
                                            </span>
                                        </td>
                                        <td>{{ $ejercicio->mecanica }}</td>
                                        <td>
                                            @if($ejercicio->video_corto)
                                                <a href="{{ $ejercicio->video_corto }}" target="_blank" class="btn btn-sm btn-info"
                                                    data-toggle="tooltip" title="Ver video">
                                                    <i class="fas fa-video"></i>
                                                </a>
                                            @else
                                                <span class="text-muted small">Sin video</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.ejercicios.edit', $ejercicio) }}"
                                                    class="btn btn-sm btn-warning" data-toggle="tooltip" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.ejercicios.destroy', $ejercicio) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este ejercicio?')"
                                                        data-toggle="tooltip" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-info m-0">
                                    No hay ejercicios registrados.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">

<style>
    #ejerciciosTable thead th {
        background-color: #343a40;
        color: white;
        font-weight: 600;
    }

    #ejerciciosTable tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
        transition: background-color 0.2s;
    }

    /* 🔍 Buscador bonito */
    .dataTables_filter input {
        border-radius: 20px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        margin-left: 8px;
    }

    .dataTables_filter label {
        font-weight: 600;
    }
</style>
@stop

@section('js')
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>

<script>
    $(document).ready(function () {

        $('#ejerciciosTable').DataTable({
            language: {
                search: "Buscar:",
                info: "Mostrando _START_ a _END_ de _TOTAL_ ejercicios",
                zeroRecords: "No se encontraron ejercicios"
            },
            pageLength: 10,
            lengthChange: false,
            ordering: true,
            order: [[0, "desc"]],
            responsive: true,

            // 🔥 MISMO LAYOUT QUE USUARIOS
            dom:
                '<"row mb-3"' +
                '<"col-md-6 d-flex align-items-center"i>' +
                '<"col-md-6 text-right"f>' +
                '>' +
                '<"row"<"col-12"tr>>' +
                '<"row mt-3"' +
                '<"col-md-6"i>' +
                '<"col-md-6"p>' +
                '>',

            drawCallback: function () {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        // Tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto-ocultar alertas
        setTimeout(function () {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@stop