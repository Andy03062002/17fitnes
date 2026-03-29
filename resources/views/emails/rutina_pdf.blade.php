@component('mail::message')
# Tu Rutina Personalizada

Hola {{ $visitante['datos_personales']['nombre'] ?? 'amigo' }},

Adjunto encontrarás tu rutina en PDF generada por 17Fitness.

@component('mail::button', ['url' => route('dashboard')])
Volver a 17Fitness
@endcomponent

Saludos,  
**Equipo 17Fitness**
@endcomponent
