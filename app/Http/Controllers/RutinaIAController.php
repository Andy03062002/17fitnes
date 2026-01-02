<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutina;
use App\Services\AnthropicAPIClient;
use App\Models\HistorialRutina;
use App\Models\PerfilUsuario;
use Parsedown;

class RutinaIAController extends Controller
{ 
    public function index()
    {
        return view('rutinaia.index'); // vista dashboard
    }
    public function generar()
    {
        $perfil = PerfilUsuario::where('user_id', auth()->id())->firstOrFail();

        $prompt = $this->crearPromptDesdePerfil($perfil);

        $client = new AnthropicAPIClient(
            config('services.anthropic.url'),
            config('services.anthropic.key')
        );

        $respuestaIA = $client->sendMessage($prompt);

        // 1. Crear rutina
        $rutina = Rutina::create([
            'user_id' => auth()->id(),
            'nombre' => 'Rutina personalizada IA',
            'descripcion' => 'Rutina generada automáticamente según perfil del usuario',
            'generada_por' => 'IA',
            'fecha_generacion' => now(),
        ]);

        // 2. Guardar historial IA
        HistorialRutina::create([
            'rutina_id' => $rutina->id,
            'prompt_usado' => $prompt,
            'respuesta_ia' => json_encode($respuestaIA),
            'fecha_generacion' => now(),
        ]);

        return redirect()->route('rutinaia.ver', $rutina->id);
    }

    private function crearPromptDesdePerfil($p)
    {
        return "
            Eres un entrenador personal profesional.

            Crea una rutina personalizada con esta estructura:
            - saludo personalizado
            - análisis del perfil
            - rutina semanal
            - recomendaciones de cuidado físico
            - frase motivacional

            Perfil del usuario:
            Edad: {$p->edad}
            Peso: {$p->peso} kg
            Altura: {$p->altura} cm
            Género: {$p->genero}
            Somatotipo: {$p->somatotipo}
            Nivel de actividad: {$p->nivel_actividad}
            Objetivo: {$p->objetivo}
            Días disponibles: {$p->disponibilidad_dias}
            Minutos por día: {$p->minutos_por_dia}
            Experiencia: {$p->experiencia}
            Lesiones: {$p->lesiones}
            ";
    }


    public function ver($id)
    {
        $rutina = Rutina::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $historial = $rutina->historial()->latest('fecha_generacion')->first();

        $texto = $this->extractTextFromAnthropicResponse(
            json_decode($historial->respuesta_ia, true)
        );

        $html = (new Parsedown())->text($texto);

        return view('rutinaia.ver', compact('rutina', 'html'));
    }

}