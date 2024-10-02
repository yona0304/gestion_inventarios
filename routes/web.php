<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\RegistrarProducto;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/bienvenido');
});

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

Route::get('/registrar-producto', [RegistrarProducto::class, 'index'])->name('producto');
Route::post('/registrar-producto/registrado', [RegistrarProducto::class, 'store'])->name('registrar.store');
