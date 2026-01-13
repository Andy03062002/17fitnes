<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutinaIAVisitanteController;
use App\Http\Controllers\PerfilUsuarioController;
use App\Http\Controllers\RutinaIAController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

// Procesar formulario
Route::post('/rutina-ia/procesar', [RutinaIAVisitanteController::class, 'procesar'])
    ->name('rutinaia.procesar');

// Ver rutina generada
Route::get('/rutina-ia/rutina', [RutinaIAVisitanteController::class, 'rutinaGenerada'])
    ->name('rutinaia.rutina');

// Enviar PDF por correo
Route::post('/rutina-ia/enviar', [RutinaIAVisitanteController::class, 'enviarPdfPorCorreo'])
    ->name('rutinaia.enviar');
