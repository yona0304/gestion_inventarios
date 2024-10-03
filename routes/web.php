<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\RegistrarCargoController;
use App\Http\Controllers\RegistrarProducto;
use App\Http\Controllers\RegistrarUsuarioController;
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


//visualizar pagina de usuarios y enviar datos, a la base de datos.
Route::get('/registrar-usuario', [RegistrarUsuarioController::class, 'index'])->name('usuario');
Route::post('/registrar-usuario/registro', [RegistrarUsuarioController::class, 'store'])->name('usuario.store');

//cargo
Route::get('/registrar-cargo', [RegistrarCargoController::class, 'index'])->name('cargo');
Route::post('/registrar-cargo/registrado', [RegistrarCargoController::class, 'store'])->name('cargo.store');
