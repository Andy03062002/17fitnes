@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios registrados</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">

        <table id="usuariosTable" class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Registrado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        @if($usuario->administrador)
                            <span class="badge badge-danger">Administrador</span>
                        @else
                            <span class="badge badge-secondary">Usuario</span>
                        @endif
                    </td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}"
                              method="POST"
                              onsubmit="return confirm('¿Eliminar usuario?')">
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
        $('#usuariosTable').DataTable({
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