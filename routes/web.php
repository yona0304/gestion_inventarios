<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\RegistrarProducto;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/bienvenido');
});

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

//mostrar index de la pagina y controlador de formulario de enviar el registro
Route::get('/registrar-producto', [RegistrarProducto::class, 'index'])->name('producto');
Route::post('/registrar-producto/registrado', [RegistrarProducto::class, 'store'])->name('registrar.store');
//obtener codigo interno de categoria
Route::get('/obtener-codigo-interno/{categoriaId}', [RegistrarProducto::class, 'obtenerCodigoInterno']);
