<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Ejercicio;

class EjercicioController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::paginate(10);

        return view('admin.ejercicios.index', compact('ejercicios'));
    }

    public function create()
    {
        return view('admin.ejercicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'grupo_muscular' => 'required|string|max:100',
            'nivel' => 'required|string|max:50',
            'mecanica' => 'required|string|max:50',
            'video_corto' => 'nullable|url',
        ]);

        Ejercicio::create($request->all());

        return redirect()
            ->route('admin.ejercicios.index')
            ->with('success', 'Ejercicio creado correctamente');
    }

    public function destroy(Ejercicio $ejercicio)
    {
        $ejercicio->delete();

        return back()->with('success', 'Ejercicio eliminado');
    }
}
