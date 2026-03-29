<?php

use App\Http\Controllers\EjercicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutinaIAVisitanteController;
use App\Http\Controllers\PerfilUsuarioController;
use App\Http\Controllers\RutinaIAController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])
        ->name('admin.usuarios.index');

    Route::get('/admin/ejercicios', [EjercicioController::class, 'index'])
        ->name('admin.ejercicios.index');

    Route::get('/admin/usuarios/create', [UsuarioController::class, 'create'])
        ->name('admin.usuarios.create');

    Route::post('/admin/usuarios', [UsuarioController::class, 'store'])
        ->name('admin.usuarios.store');

    Route::get('/admin/usuarios/{user}/edit', [UsuarioController::class, 'edit'])
        ->name('admin.usuarios.edit');

    Route::put('/admin/usuarios/{user}', [UsuarioController::class, 'update'])
        ->name('admin.usuarios.update');

    Route::delete('/admin/usuarios/{user}', [UsuarioController::class, 'destroy'])
        ->name('admin.usuarios.destroy');



    Route::delete('/admin/usuarios/{user}', [UsuarioController::class, 'destroy'])
        ->name('admin.usuarios.destroy');



    Route::get('/admin/ejercicios/create', [EjercicioController::class, 'create'])
        ->name('admin.ejercicios.create');

    Route::post('/admin/ejercicios', [EjercicioController::class, 'store'])
        ->name('admin.ejercicios.store');

    Route::get('/admin/ejercicios/{ejercicio}/edit', [EjercicioController::class, 'edit'])
        ->name('admin.ejercicios.edit');

    Route::put('/admin/ejercicios/{ejercicio}', [EjercicioController::class, 'update'])
        ->name('admin.ejercicios.update');

    Route::delete('/admin/ejercicios/{ejercicio}', [EjercicioController::class, 'destroy'])
        ->name('admin.ejercicios.destroy');

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/entrenar-hoy', [App\Http\Controllers\EntrenarHoyController::class, 'index'])->name('entrenar.index');
    Route::post('/entrenar-hoy', [App\Http\Controllers\EntrenarHoyController::class, 'filtrar'])->name('entrenar.filtrar');
});

Route::middleware('auth')->group(function () {

    Route::get('/perfil', [PerfilUsuarioController::class, 'index'])->name('perfil.index');
    Route::post('/perfil', [PerfilUsuarioController::class, 'store'])->name('perfil.store');

});

Route::middleware('auth')->group(function () {

    Route::get('/rutina', fn() => view('rutina.index'))
        ->name('rutina.index');

    Route::post('/rutina/generar', [RutinaIAController::class, 'generar'])
        ->name('rutina.generar');

    Route::get('/rutina/{id}', [RutinaIAController::class, 'ver'])
        ->name('rutina.ver');

    Route::get('/rutina-historial', [RutinaIAController::class, 'historial'])
        ->name('rutina.historial');
});





// Formulario de rutina IA
Route::get('/rutina-ia', [RutinaIAVisitanteController::class, 'index'])
    ->name('rutinaia.formulario');

Route::post('/rutina-ia', [RutinaIAVisitanteController::class, 'store'])
    ->name('rutina.store');

// Procesar formulario
Route::post('/rutina-ia/procesar', [RutinaIAVisitanteController::class, 'procesar'])
    ->name('rutinaia.procesar');

// Ver rutina generada
Route::get('/rutina-ia/rutina', [RutinaIAVisitanteController::class, 'rutinaGenerada'])
    ->name('rutinaia.rutina');

// Enviar PDF por correo
Route::post('/rutina-ia/enviar', [RutinaIAVisitanteController::class, 'enviarPdfPorCorreo'])
    ->name('rutinaia.enviar');



Route::post('/perfil/calendario/marcar', [PerfilUsuarioController::class, 'marcarDia'])
    ->name('perfil.calendario.marcar');

Route::post('/perfil/calendario/eliminar', [PerfilUsuarioController::class, 'eliminarDia'])
    ->name('perfil.calendario.eliminar');

Route::post('/entrenamiento/toggle', [PerfilUsuarioController::class, 'toggle'])
    ->name('entrenamiento.toggle');

Route::get('/entrenamiento/eventos', [PerfilUsuarioController::class, 'eventos'])
    ->name('entrenamiento.eventos');
