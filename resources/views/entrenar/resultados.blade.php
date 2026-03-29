@extends('adminlte::page')

@section('title', 'Resultados')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Ejercicios recomendados</h1>

    <a href="{{ route('entrenar.index') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
</div>
@stop

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <input type="text"
               id="buscadorEjercicios"
               class="form-control"
               placeholder="Buscar por nombre, nivel, grupo muscular o mecánica">
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary btn-block" id="btnBuscar">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>
</div>
<div class="row" id="contenedorEjercicios">

@forelse($ejercicios as $e)
    <div class="col-md-4 mb-3 ejercicio-card"
         data-nombre="{{ strtolower($e->nombre) }}"
         data-nivel="{{ strtolower($e->nivel_dificultad) }}"
         data-grupo="{{ strtolower($e->grupo_muscular_objetivo) }}"
         data-mecanica="{{ strtolower($e->mecanica) }}">

        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                {{ $e->nombre }}
            </div>

            <div class="card-body">
                <p><strong>Grupo muscular:</strong> {{ $e->grupo_muscular_objetivo }}</p>
                <p><strong>Nivel:</strong> {{ $e->nivel_dificultad }}</p>
                <p><strong>Mecánica:</strong> {{ $e->mecanica }}</p>

                @if($e->video_corto)
                    <button class="btn btn-dark btn-sm btn-video"
                            data-video="{{ $e->video_corto }}">
                        <i class="fas fa-play"></i> Ver video
                    </button>
                @endif
            </div>
        </div>
    </div>
@empty
    <p class="text-danger">No se encontraron ejercicios.</p>
@endforelse

</div>
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Video del ejercicio</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body p-0">
                <iframe id="videoFrame"
                        width="100%"
                        height="450"
                        frameborder="0"
                        allowfullscreen>
                </iframe>
            </div>

        </div>
    </div>
</div>


@stop
@section('js')
<script>
document.getElementById('btnBuscar').addEventListener('click', function () {
    const texto = document.getElementById('buscadorEjercicios')
                    .value.toLowerCase()
                    .trim();

    const cards = document.querySelectorAll('.ejercicio-card');

    cards.forEach(card => {
        const contenido =
            card.dataset.nombre +
            card.dataset.nivel +
            card.dataset.grupo +
            card.dataset.mecanica;

        card.style.display = contenido.includes(texto) ? '' : 'none';
    });
});
</script>
@stop
@section('js')
<script>
// BUSCAR
document.getElementById('btnBuscar').addEventListener('click', function () {
    const texto = document.getElementById('buscadorEjercicios').value.toLowerCase();
    document.querySelectorAll('.ejercicio-card').forEach(card => {
        const data = card.dataset.nombre +
                     card.dataset.nivel +
                     card.dataset.grupo +
                     card.dataset.mecanica;
        card.style.display = data.includes(texto) ? '' : 'none';
    });
});

// VIDEO MODAL (SIN CAMBIAR LINK)
document.querySelectorAll('.btn-video').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('videoFrame').src = this.dataset.video;
        $('#videoModal').modal('show');
    });
});

// limpiar iframe al cerrar
$('#videoModal').on('hidden.bs.modal', function () {
    document.getElementById('videoFrame').src = '';
});
</script>
@stop

