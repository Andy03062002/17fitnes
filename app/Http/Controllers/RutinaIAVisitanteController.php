<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;
use Illuminate\Support\Facades\Http;
use App\Services\AnthropicAPIClient;
use Barryvdh\DomPDF\Facade\Pdf; // asegúrate de que el alias exista: use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\RutinaPdfMail; // el mailable que crearemos
use Illuminate\Support\Facades\Mail;
use Parsedown;

class RutinaIAVisitanteController extends Controller
{
    public function index()
    {
        return view('rutinaia.formulario');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email',
            'edad' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
        ]);

        $visitante = Visitante::create($request->all());

    }

    // MÉTODO PROCESAR
    public function procesar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email',
        ]);
        // SOLO GUARDAR ESTOS CAMPOS EN LA BD
        $visitante = Visitante::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'edad' => $request->edad,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'ciudad' => $request->ciudad,
        ]);
        $json = [
            'datos_personales' => [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'edad' => $request->edad,
            ],
            'datos_fisicos' => [
                'peso' => $request->peso,
                'altura' => $request->altura,
                'nivel_actividad' => $request->nivel_actividad,
                'objetivo' => $request->objetivo,
                'experiencia' => $request->experiencia,
            ],
            'preferencias' => [
                'dias_disponibles' => $request->dias_disponibles,
                'minutos_por_dia' => $request->minutos_por_dia,
                'grupo_muscular' => $request->grupo_muscular,
                'nivel_dificultad' => $request->nivel_dificultad,
            ],
        ];


        // Crear prompt desde el JSON
        $prompt = $this->dictToPrompt($json);

        // Guardar ambos
        session([
            'rutina_json' => $json,
            'prompt' => $prompt
        ]);
        session(['visitante_correo' => $visitante->correo]);

        // Llamar a la IA
        $client = new AnthropicAPIClient(
            config('services.anthropic.url'),
            config('services.anthropic.key'),
        );

        $respuestaIA = $client->sendMessage($prompt);


        // Guardar rutina generada 
        session(['rutinaia' => $respuestaIA]);

        return redirect()->route('rutinaia.rutina');
    }

    public function rutinaGenerada()
    {
        $json = session('rutina_json');
        $prompt = session('prompt');
        $rutina = session('rutinaia');

        if (!$json) {
            return redirect()->route('rutinaia.formulario')
                ->with('error', 'No hay datos para generar la rutina.');
        }

        // 1. Extraemos el texto bruto generado por la IA
        $texto = $this->extractTextFromAnthropicResponse($rutina);

        // 2. Convertimos Markdown → HTML
        $Parsedown = new Parsedown();
        $htmlRutina = $Parsedown->text($texto);

        return view('rutinaia.rutina', [
            'json' => $json,
            'rutina_markdown' => $texto,
            'rutina_html' => $htmlRutina,
        ]);
    }

    private function dictToPrompt(array $data): string
    {
        $dp = $data["datos_personales"];
        $df = $data["datos_fisicos"];
        $p = $data["preferencias"];

        return "
        Genera un plan de entrenamiento con peso corporal de manera corta ajustado 
        a las necesidades del usuario dando un saludo perosonalizado
        y evitando recomendaciones extensas manteniendo la estructura de:

        -saludo personalizado
        -analisis y recomenandación
        -plan de entrenamiento semanal con ejercicios diarios
        -guía nutricional basico que acompañe el entrenamiento con productos naturales 
        -frase motivacional de cierre

        


        Nombre: {$dp['nombre']} {$dp['apellido']}
        Edad: {$dp['edad']}

        Datos físicos:
        Peso: {$df['peso']} kg
        Altura: {$df['altura']} cm
        Actividad: {$df['nivel_actividad']}
        Objetivo: {$df['objetivo']}
        Experiencia: {$df['experiencia']}

        Preferencias:
        Días disponibles: {$p['dias_disponibles']}
        Minutos por día: {$p['minutos_por_dia']}
        Grupo muscular: {$p['grupo_muscular']}
        Dificultad: {$p['nivel_dificultad']}
        ";
    }

    public function enviarPdfPorCorreo(Request $request)
    {
        $json = session('rutina_json');
        $prompt = session('prompt');
        $rutina = session('rutinaia');

        if (!$json || !$rutina) {
            return redirect()->back()->with('error', 'No hay rutina para enviar.');
        }

        $texto = $this->extractTextFromAnthropicResponse($rutina);

        $pdfData = [
            'json' => $json,
            'prompt' => $prompt,
            'texto' => $texto,
        ];

        $Parsedown = new Parsedown();
        $htmlRutina = $Parsedown->text($texto);

        // Generar PDF desde la vista 'rutinaia.pdf' (crearemos la vista abajo)
        $pdf = Pdf::loadView('rutinaia.pdf', [
            'json' => $json,
            'rutina_html' => $htmlRutina
        ])->setPaper('a4', 'portrait');

        // Obtener bytes del PDF
        $pdfBytes = $pdf->output();

        // Correo del visitante (lo guardaste en BD o en el request - aquí lo obtendremos del JSON si se guardó)
        // asumimos que guardaste correo al crear Visitante y que está accesible
        $email = session('visitante_correo');

        if (!$email) {
            return redirect()->back()->with('error', 'No se encontró el correo del visitante.');
        }


        // Enviar mailable con PDF adjunto (RutinaPdfMail lo crearemos)
        Mail::to($email)->send(new RutinaPdfMail($pdfBytes, $json));

        return redirect()->route('rutinaia.rutina')->with('success', 'Rutina enviada por correo correctamente.');
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


    public function verPdf(Request $request)
    {
        $json = session('rutina_json');
        $prompt = session('prompt');
        $rutina = session('rutinaia');

        if (!$json || !$rutina) {
            // Puedes redirigir al formulario si no hay datos en sesión
            return redirect()->route('rutinaia.formulario')->with('error', 'No hay rutina para previsualizar.');
        }

        $texto = $this->extractTextFromAnthropicResponse($rutina); // Asumo que tienes este método

        $Parsedown = new Parsedown();
        $htmlRutina = $Parsedown->text($texto);

        // Generar PDF desde la vista 'rutinaia.pdf'
        $pdf = Pdf::loadView('rutinaia.pdf', [
            'json' => $json,
            'rutina_html' => $htmlRutina
        ])->setPaper('a4', 'portrait');

        // Devolver el PDF directamente en el navegador para previsualización
        return $pdf->stream('rutina-17fitness.pdf');
    }





}
