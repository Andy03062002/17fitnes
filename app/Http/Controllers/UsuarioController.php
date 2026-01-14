<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('administrador')->paginate(10);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function destroy(User $user)
    {
        // Evitar que un admin se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
