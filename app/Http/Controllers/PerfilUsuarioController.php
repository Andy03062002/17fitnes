<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilUsuario;
use App\Models\RegistroEntrenamiento;

class PerfilUsuarioController extends Controller
{
    public function index()
    {
        $perfil = PerfilUsuario::where('user_id', auth()->id())->first();

        $diasEntrenados = RegistroEntrenamiento::where('user_id', auth()->id())
            ->get()
            ->map(function ($d) {
                return [
                    'title' => 'Entrenado',
                    'start' => $d->fecha,
                    'color' => '#28a745'
                ];
            });

        return view('perfil.index', compact('perfil', 'diasEntrenados'));


        return view('perfil.index', compact('perfil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'edad' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'disponibilidad_dias' => 'nullable|integer',
            'minutos_por_dia' => 'nullable|integer',
        ]);

        PerfilUsuario::updateOrCreate(
            ['user_id' => auth()->id()],
            $request->all() + ['user_id' => auth()->id()]
        );

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function marcarDia(Request $request)
    {
        RegistroEntrenamiento::firstOrCreate([
            'user_id' => auth()->id(),
            'fecha' => $request->fecha,
        ]);

        return response()->json(['ok' => true]);
    }

    public function eliminarDia(Request $request)
    {
        RegistroEntrenamiento::where('user_id', auth()->id())
            ->where('fecha', $request->fecha)
            ->delete();

        return response()->json(['ok' => true]);
    }

    // MÉTODO PARA MARCAR/DESMARCAR
    public function toggle(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date'
        ]);
        
        try {
            $registro = RegistroEntrenamiento::where('user_id', auth()->id())
                ->where('fecha', $request->fecha)
                ->first();
            
            if ($registro) {
                $registro->delete();
                return response()->json([
                    'status' => 'removed',
                    'message' => 'Día desmarcado'
                ]);
            }
            
            RegistroEntrenamiento::create([
                'user_id' => auth()->id(),
                'fecha' => $request->fecha
            ]);
            
            return response()->json([
                'status' => 'added',
                'message' => 'Día marcado como entrenado'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


    // MÉTODO NUEVO PARA OBTENER EVENTOS
    public function eventos()
    {
        $eventos = RegistroEntrenamiento::where('user_id', auth()->id())
            ->get()
            ->map(function ($registro) {
                return [
                    'title' => '🏋️ Entrenado',
                    'start' => $registro->fecha,
                    'allDay' => true,
                    'color' => '#10B981', // Verde más atractivo
                    'textColor' => '#FFFFFF',
                    'borderColor' => '#059669'
                ];
            });
            
        return response()->json($eventos);
    }
}

