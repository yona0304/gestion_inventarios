<?php

use App\Http\Controllers\AlquilerEquipoController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\DotacionController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\RegistrarCategoriaController;
use App\Http\Controllers\RegistrarProducto;
use App\Http\Controllers\RegistrarUsuarioController;
use App\Http\Controllers\RetirarController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\DotacionController;
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

//categoria
Route::get('/registrar-categoria', [RegistrarCategoriaController::class, 'index'])->name('categoria');
Route::post('/registrar-categoria/registrado', [RegistrarCategoriaController::class, 'store'])->name('categoria.store');

//vehiculo
Route::get('/registrar-vehiculo', [VehiculoController::class, 'index'])->name('vehiculo');
Route::post('/registrar-vehiculo/registro', [VehiculoController::class, 'store'])->name('vehiculo.store');

//asignar
Route::get('/registrar-asignacion', [AsignarController::class, 'index'])->name('asignar');
Route::post('/registrar-asignacion/registrado', [AsignarController::class, 'store'])->name('asignar.store');

//devolucion
Route::get('/retirar-asignacion', [RetirarController::class, 'index'])->name('retirar');
Route::get('/retirar-asignacion/{id_producto}/{identificacion}', [RetirarController::class, 'show']);
Route::put('/retirar-asignacion/actualizar', [RetirarController::class, 'update'])->name('retirar.update');

//alquiler equipo
Route::get('/alquiler-equipo', [AlquilerEquipoController::class, 'index'])->name('alquiler');
Route::post('/alquiler-equipo/registro', [AlquilerEquipoController::class, 'store'])->name('alquiler.store');
Route::get('/equipos-alquilados', [AlquilerEquipoController::class, 'list'])->name('alquiler.list');


Route::put('/equipos-alquilados/{id}/finalizar', [AlquilerEquipoController::class, 'finalizar'])->name('finalizar');


//asignar
Route::get('/dotacion', [DotacionController::class, 'index'])->name('dotacion');
Route::get('/dotacion/registrado', [DotacionController::class, 'dotacion'])->name('dotacion');
