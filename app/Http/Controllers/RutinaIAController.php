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
        return view('rutina.index'); // vista dashboard
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

        return redirect()->route('rutina.ver', $rutina->id);
    }

    private function crearPromptDesdePerfil($p)
    {
        return "
            Eres un entrenador personal profesional.

            Crea una rutina personalizada con esta estructura:
            - saludo personalizado(corto)
            - rutina semanal(nomas de 6 ejercicios por dia)
            - recomendaciones de cuidado físico

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

        return view('rutina.ver', [
            'rutina' => $rutina,
            'htmlRutina' => $html
        ]);
    }

    private function extractTextFromAnthropicResponse($respuesta)
    {
        // Respuesta puede ser array con 'success' y 'data' o un objeto. Trabajamos robustamente.
        if (is_array($respuesta) && !empty($respuesta['success']) && !empty($respuesta['data'])) {
            $data = $respuesta['data'];

            // En muchos retornos de Anthropic: data.content[0].text
            if (!empty($data['content'][0]['text'])) {
                return $data['content'][0]['text'];
            }

            // Si estructura distinta, intenta otros campos
            if (!empty($data['outputs'][0]['content'][0]['text'])) {
                return $data['outputs'][0]['content'][0]['text'];
            }

            // Si viene raw como 'text'
            if (!empty($data['text'])) {
                return $data['text'];
            }

            // fallback: devolver json pretty
            return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Si viene como string
        if (is_string($respuesta)) {
            return $respuesta;
        }

        // si viene un objeto con ->data etc.
        if (is_object($respuesta)) {
            // intenta convertir a array
            $arr = json_decode(json_encode($respuesta), true);
            return $this->extractTextFromAnthropicResponse(['success' => true, 'data' => $arr]);
        }

        return 'No se pudo extraer contenido de la respuesta de la IA.';
    }

    public function historial()
    {
        $rutinas = Rutina::where('user_id', auth()->id())
            ->orderBy('fecha_generacion', 'desc')
            ->get();

        return view('rutina.historial', compact('rutinas'));
    }
}