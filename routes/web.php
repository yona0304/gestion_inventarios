<?php

use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/bienvenido');
});

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
