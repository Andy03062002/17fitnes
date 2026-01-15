@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Usuarios registrados</h1>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-dark">
            <h3 class="card-title mb-0">
                <i class="fas fa-users mr-2"></i>Lista de Usuarios
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usuariosTable" class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
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
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>
                                    <span class="badge badge-secondary">#{{ $usuario->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2">
                                            <i class="fas fa-user-circle fa-lg text-muted"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $usuario->name }}</strong>
                                            @if($usuario->email_verified_at)
                                                <small class="d-block text-success">
                                                    <i class="fas fa-check-circle fa-xs"></i> Verificado
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $usuario->email }}" class="text-primary">
                                        <i class="fas fa-envelope mr-1"></i>{{ $usuario->email }}
                                    </a>
                                </td>
                                <td>
                                    @if($usuario->administrador)
                                        <span class="badge badge-danger badge-pill">
                                            <i class="fas fa-crown mr-1"></i>Administrador
                                        </span>
                                    @else
                                        <span class="badge badge-primary badge-pill">
                                            <i class="fas fa-user mr-1"></i>Usuario
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div class="font-weight-bold">
                                            {{ $usuario->created_at->format('d/m/Y') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $usuario->created_at->format('h:i A') }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" 
                                           class="btn btn-sm btn-warning"
                                           data-toggle="tooltip"
                                           title="Editar usuario">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        

                                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" 
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar al usuario {{ $usuario->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    data-toggle="tooltip"
                                                    title="Eliminar usuario">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="alert alert-info m-0">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        No hay usuarios registrados en el sistema.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Nota: DataTable maneja su propia paginación, 
             pero si quieres mantener la paginación de Laravel, 
             usa este código comentado -->
        {{--
        @if($usuarios->hasPages())
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            {{ $usuarios->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            </div>
        @endif
        --}}
    </div>
@stop

@section('css')
    <style>
        /* Estilos personalizados para mejorar la tabla */
        #usuariosTable thead th {
            background-color: #343a40;
            color: white;
            font-weight: 600;
            border-bottom: 2px solid #454d55;
        }
        
        #usuariosTable tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transition: background-color 0.2s;
        }
        
        .badge-pill {
            padding: 0.4em 0.8em;
            font-size: 0.85em;
        }
        
        .btn-group .btn {
            margin-right: 2px;
        }
        
        .btn-group .btn:last-child {
            margin-right: 0;
        }
        
        /* Estilo para el botón de eliminar */
        .btn-danger:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
        }
        
        /* Estilos para DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin-left: -1px;
            line-height: 1.5;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #0056b3;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            $('#usuariosTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
                    "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
                    "zeroRecords": "No se encontraron usuarios",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "pageLength": 10,
                "lengthChange": false,
                "ordering": true,
                "order": [[0, "desc"]], // Ordenar por ID descendente
                "responsive": true,
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                       '<"row"<"col-sm-12"tr>>' +
                       '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "drawCallback": function(settings) {
                    // Reinicializar tooltips después de cada dibujo de la tabla
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
            
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Auto-ocultar alertas después de 5 segundos
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Confirmación personalizada para eliminar
            $(document).on('submit', 'form[onsubmit]', function(e) {
                const usuarioName = $(this).data('usuario-name') || 'este usuario';
                return confirm(`¿Estás seguro de eliminar a ${usuarioName}? Esta acción no se puede deshacer.`);
            });
            
            // Agregar efectos a los botones
            $('.btn-group .btn').hover(
                function() {
                    $(this).css('transform', 'translateY(-2px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script>
@stop