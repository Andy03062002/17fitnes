<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ejercicio;

class EntrenarHoyController extends Controller
{
    public function index()
    {
        return view('entrenar.index'); // formulario
    }

    public function filtrar(Request $request)
    {
        $query = DB::table('ejercicios');

        if ($request->nivel) {
            $query->where('nivel_dificultad', $request->nivel);
        }

        if ($request->grupo) {
            $query->where('grupo_muscular_objetivo', $request->grupo);
        }

        if ($request->mecanica) {
            $query->where('mecanica', $request->mecanica);
        }

        // obtener resultados
        $ejercicios = $query->get();

        return view('entrenar.resultados', compact('ejercicios'));
    }
}
