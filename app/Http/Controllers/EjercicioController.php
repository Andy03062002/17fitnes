<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Ejercicio;

class EjercicioController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::paginate(5);

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
            'grupo_muscular_objetivo' => 'required|string|max:100',
            'nivel_dificultad' => 'required|string|max:50',
            'mecanica' => 'required|string|max:50',
            'video_corto' => 'nullable|url',
        ]);

        Ejercicio::create($request->all());

        return redirect()
            ->route('admin.ejercicios.index')
            ->with('success', 'Ejercicio creado correctamente');
    }

    public function edit(Ejercicio $ejercicio)
{
    return view('admin.ejercicios.edit', compact('ejercicio'));
}
    public function update(Request $request, Ejercicio $ejercicio)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'grupo_muscular_objetivo' => 'required|string|max:100',
        'nivel_dificultad' => 'required|string|max:50',
        'mecanica' => 'required|string|max:50',
        'video_corto' => 'nullable|string',
    ]);

    $ejercicio->update($request->only([
        'nombre',
        'grupo_muscular_objetivo',
        'nivel_dificultad',
        'mecanica',
        'video_corto',
    ]));

    return redirect()
        ->route('admin.ejercicios.index')
        ->with('success', 'Ejercicio actualizado correctamente.');
}

    public function destroy(Ejercicio $ejercicio)
    {
        $ejercicio->delete();

        return back()->with('success', 'Ejercicio eliminado');
    }
}
