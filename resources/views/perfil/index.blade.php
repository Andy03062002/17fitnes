@extends('adminlte::page')

{{-- En el CSS --}}
@push('css')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .fc-day-today {
        background-color: #EFF6FF !important;
        border: 2px solid #3B82F6 !important;
    }
    
    .fc-button {
        background-color: #3B82F6 !important;
        border-color: #3B82F6 !important;
    }
    
    .fc-button:hover {
        background-color: #2563EB !important;
    }
    
    .fc-daygrid-day:hover {
        background-color: #F9FAFB !important;
        cursor: pointer;
    }
</style>
@endpush

@section('title', 'Perfil Físico')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Mi Perfil Físico</h1>

    <a href="{{ route('dashboard') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar al Dashboard
    </a>
</div>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('perfil.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-3">
                    <label>Edad</label>
                    <input type="number" name="edad" value="{{ $perfil->edad ?? '' }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.01" name="peso" value="{{ $perfil->peso ?? '' }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Altura (cm)</label>
                    <input type="number" step="0.01" name="altura" value="{{ $perfil->altura ?? '' }}"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Género</label>
                    <select name="genero" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Masculino" {{ ($perfil->genero ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino
                        </option>
                        <option value="Femenino" {{ ($perfil->genero ?? '') == 'Femenino' ? 'selected' : '' }}>Femenino
                        </option>
                        <option value="Otro" {{ ($perfil->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Somatotipo</label>
                    <select name="somatotipo" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Ectomorfo" {{ ($perfil->somatotipo ?? '') == 'Ectomorfo' ? 'selected' : '' }}>Ectomorfo
                        </option>
                        <option value="Mesomorfo" {{ ($perfil->somatotipo ?? '') == 'Mesomorfo' ? 'selected' : '' }}>Mesomorfo
                        </option>
                        <option value="Endomorfo" {{ ($perfil->somatotipo ?? '') == 'Endomorfo' ? 'selected' : '' }}>Endomorfo
                        </option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Nivel de Actividad</label>
                    <select name="nivel_actividad" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Sedentario" {{ ($perfil->nivel_actividad ?? '') == 'Sedentario' ? 'selected' : '' }}>
                            Sedentario</option>
                        <option value="Moderado" {{ ($perfil->nivel_actividad ?? '') == 'Moderado' ? 'selected' : '' }}>
                            Moderado</option>
                        <option value="Activo" {{ ($perfil->nivel_actividad ?? '') == 'Activo' ? 'selected' : '' }}>Activo
                        </option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Objetivo</label>
                    <select name="objetivo" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Aumentar masa muscular" {{ ($perfil->objetivo ?? '') == 'Aumentar masa muscular' ? 'selected' : '' }}>Aumentar masa muscular</option>
                        <option value="Perder grasa" {{ ($perfil->objetivo ?? '') == 'Perder grasa' ? 'selected' : '' }}>
                            Perder grasa</option>
                        <option value="Tonificar" {{ ($perfil->objetivo ?? '') == 'Tonificar' ? 'selected' : '' }}>Tonificar
                        </option>
                        <option value="Resistencia" {{ ($perfil->objetivo ?? '') == 'Resistencia' ? 'selected' : '' }}>
                            Resistencia</option>
                    </select>
                </div>

                <div class="col-md-6 mt-3">
                    <label>Días disponibles a la semana</label>
                    <input type="number" name="disponibilidad_dias" value="{{ $perfil->disponibilidad_dias ?? '' }}"
                        class="form-control">
                </div>

                <div class="col-md-6 mt-3">
                    <label>Minutos por día</label>
                    <input type="number" name="minutos_por_dia" value="{{ $perfil->minutos_por_dia ?? '' }}"
                        class="form-control">
                </div>

                <div class="col-md-12 mt-3">
                    <label>Lesiones</label>
                    <textarea name="lesiones" class="form-control" rows="2">{{ $perfil->lesiones ?? '' }}</textarea>
                </div>

                <div class="col-md-12 mt-3">
                    <label>Nivel de Experiencia</label>
                    <select name="experiencia" class="form-control">
                        <option value="">Seleccione...</option>
                        <option value="Principiante" {{ ($perfil->experiencia ?? '') == 'Principiante' ? 'selected' : '' }}>
                            Principiante</option>
                        <option value="Intermedio" {{ ($perfil->experiencia ?? '') == 'Intermedio' ? 'selected' : '' }}>
                            Intermedio</option>
                        <option value="Avanzado" {{ ($perfil->experiencia ?? '') == 'Avanzado' ? 'selected' : '' }}>Avanzado
                        </option>
                    </select>
                </div>

            </div>

            <button class="btn btn-primary mt-4">Guardar Perfil</button>
        </form>

        <div class="card mt-4 shadow-sm">
    <div class="card-header bg-gradient-primary text-white">
        <h5 class="mb-0">📅 Registro de Entrenamientos</h5>
        <small class="d-block mt-1">Haz clic en cualquier día para marcarlo como entrenado</small>
    </div>
    <div class="card-body p-3">
        <div id="calendar"></div>
        
        {{-- Estadísticas --}}
        <div class="row mt-4 text-center">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="text-muted">Días este mes</h6>
                        <h3 id="dias-mes" class="mb-0">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="text-muted">Racha actual</h6>
                        <h3 id="racha-actual" class="mb-0">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="text-muted">Total días</h6>
                        <h3 id="total-dias" class="mb-0">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>
</div>

@stop
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
@endpush

{{-- JavaScript --}}
@push('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/es.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        firstDay: 1, // Lunes como primer día
        
        // ✅ EVENTOS DINÁMICOS
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch("{{ route('entrenamiento.eventos') }}")
                .then(response => response.json())
                .then(data => {
                    successCallback(data);
                    // Actualizar estadísticas después de cargar eventos
                    actualizarEstadisticas(data);
                })
                .catch(error => {
                    console.error('Error cargando eventos:', error);
                    failureCallback(error);
                });
        },
        
        // ✅ CLICK EN DÍA
        dateClick: function(info) {
            // Opcional: prevenir marcar fechas futuras
            // if (info.dateStr > new Date().toISOString().split('T')[0]) {
            //     alert('No puedes marcar días futuros');
            //     return;
            // }
            
            // Mostrar loading
            info.dayEl.style.opacity = '0.7';
            
            fetch("{{ route('entrenamiento.toggle') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    fecha: info.dateStr
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta');
                }
                return response.json();
            })
            .then(data => {
                // Quitar loading
                info.dayEl.style.opacity = '1';
                
                // Refrescar eventos
                calendar.refetchEvents();
                
                // Mostrar notificación
                mostrarNotificacion(data.message);
            })
            .catch(error => {
                info.dayEl.style.opacity = '1';
                console.error('Error:', error);
                mostrarNotificacion('Error al actualizar el día', 'error');
            });
        },
        
        // ✅ ESTILOS
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana'
        },
        height: 'auto',
        dayMaxEvents: true,
    });
    
    calendar.render();
    
    // ✅ FUNCIÓN PARA ACTUALIZAR ESTADÍSTICAS
    function actualizarEstadisticas(eventos) {
        const hoy = new Date();
        const mesActual = hoy.getMonth();
        const añoActual = hoy.getFullYear();
        
        // Días este mes
        const diasEsteMes = eventos.filter(e => {
            const fechaEvento = new Date(e.start);
            return fechaEvento.getMonth() === mesActual && 
                   fechaEvento.getFullYear() === añoActual;
        }).length;
        
        // Racha actual (días consecutivos hasta hoy)
        const fechasOrdenadas = eventos
            .map(e => e.start)
            .sort()
            .reverse();
        
        let racha = 0;
        let fechaActual = new Date();
        fechaActual.setHours(0, 0, 0, 0);
        
        for (let fecha of fechasOrdenadas) {
            const fechaEvento = new Date(fecha);
            fechaEvento.setHours(0, 0, 0, 0);
            
            const diffDias = Math.floor((fechaActual - fechaEvento) / (1000 * 60 * 60 * 24));
            
            if (diffDias === racha) {
                racha++;
                fechaActual.setDate(fechaActual.getDate() - 1);
            } else {
                break;
            }
        }
        
        // Actualizar UI
        document.getElementById('dias-mes').textContent = diasEsteMes;
        document.getElementById('racha-actual').textContent = racha;
        document.getElementById('total-dias').textContent = eventos.length;
    }
    
    // ✅ FUNCIÓN PARA NOTIFICACIONES
    function mostrarNotificacion(mensaje, tipo = 'success') {
        // Puedes usar Toastr, SweetAlert o una alerta simple
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: ${tipo === 'success' ? '#10B981' : '#EF4444'};
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;
        toast.textContent = mensaje;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // ✅ Añadir estilos CSS para animaciones
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush