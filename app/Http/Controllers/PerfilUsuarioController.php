<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilUsuario;

class PerfilUsuarioController extends Controller
{
    public function index()
    {
        $perfil = PerfilUsuario::where('user_id', auth()->id())->first();

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
}

