<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rutina 17Fitness</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .titulo { font-size: 22px; font-weight: bold; margin-bottom: 10px; }
        .sub { font-size: 16px; font-weight: bold; margin-top: 20px; }
        .content { margin-top: 10px; line-height: 1.5; }
    </style>
</head>
<body>

<div class="titulo">Rutina Personalizada - 17Fitness</div>

<p><strong>Nombre:</strong> {{ $json['datos_personales']['nombre'] }}</p>
<p><strong>Edad:</strong> {{ $json['datos_personales']['edad'] }}</p>
<p><strong>Objetivo:</strong> {{ $json['datos_fisicos']['objetivo'] }}</p>

<hr>

<div class="content">
    {!! $rutina_html !!}
</div>

</body>
</html>
