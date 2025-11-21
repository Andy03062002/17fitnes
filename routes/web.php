<?php

use Illuminate\Support\Facades\Route;

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

