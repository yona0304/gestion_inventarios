<?php

use App\Http\Controllers\AlquilerEquipoController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DotacionController;
use App\Http\Controllers\HistorialComputoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ListaAsignadosController;
use App\Http\Controllers\ListaProductosController;
use App\Http\Controllers\RegistrarCategoriaController;
use App\Http\Controllers\RegistrarProducto;
use App\Http\Controllers\RegistrarUsuarioController;
use App\Http\Controllers\RetirarController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\DotaRegistroController;
use App\Http\Controllers\ListaEquiposAlquiladosController;
use App\Http\Controllers\ListaVehiculosController;
use App\Http\Controllers\NovedadController;
use App\Http\Middleware\NoCache;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfSessionExpired;


// Login
Route::get('/', [AuthController::class, 'login'])->name('login')->middleware(NoCache::class);
Route::post('/', [AuthController::class, 'authenticate'])->name('auth.authenticate')->middleware(NoCache::class);

Route::middleware(['auth', NoCache::class, RedirectIfSessionExpired::class])->group(function () {

    //consultar dotacion del personal
    Route::get('/Dotacion', [DotacionController::class, 'index'])->name('Dotacion');
    Route::post('/Dotacion/Registrado', [DotacionController::class, 'dotacion'])->name('Dotacion.Reg');

    //listas de productos, vehiculos y asignaciones
    Route::get('/lista-productos', [ListaProductosController::class, 'index'])->name('lis.produc');
    Route::get('/lista-asignaciones', [ListaAsignadosController::class, 'index'])->name('lis.asignados');
    Route::get('/lista-vehiculos', [ListaVehiculosController::class, 'index'])->name('lis.vehiculos');

    //mostrar datos en la lista de asignación, productos y vehiculos
    Route::get('/datos/{id}', [ListaAsignadosController::class, 'datos']);
    Route::get('/datos-producto/{id}', [ListaProductosController::class, 'datosAsignacion']);
    Route::get('/datos-vehiculo/{id}', [ListaVehiculosController::class, 'datosVehiculo']);
});

Route::middleware(['auth', NoCache::class, CheckRole::class, RedirectIfSessionExpired::class])->group(function () {

    //Inicio
    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
    Route::get('/inicio/{id}', [InicioController::class, 'asignacion']);

    //mostrar index de la pagina y controlador de formulario de enviar el registro
    Route::get('/registrar-producto', [RegistrarProducto::class, 'index'])->name('producto');
    Route::post('/registrar-producto/registrado', [RegistrarProducto::class, 'store'])->name('registrar.store');
    //obtener codigo interno de categoria
    Route::get('/obtener-codigo-interno/{categoriaId}', [RegistrarProducto::class, 'obtenerCodigoInterno']);

    //visualizar pagina de usuarios y enviar datos, a la base de datos.
    Route::get('/registrar-usuario', [RegistrarUsuarioController::class, 'index'])->name('usuario');
    Route::post('/registrar-usuario/registro', [RegistrarUsuarioController::class, 'store'])->name('usuario.store');

    //categoria, visualizar, registrar y eliminar
    Route::get('/registrar-categoria', [RegistrarCategoriaController::class, 'index'])->name('categoria');
    Route::post('/registrar-categoria/registrado', [RegistrarCategoriaController::class, 'store'])->name('categoria.store');
    Route::delete('/registrar-categoria/{id}', [RegistrarCategoriaController::class, 'destroy']);

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

    //lista de quipos alquilados, finalizar e importar
    Route::get('/equipos-alquilados', [ListaEquiposAlquiladosController::class, 'index'])->name('alquiler.index');
    Route::put('/equipos-alquilados/{id}/finalizar', [ListaEquiposAlquiladosController::class, 'finalizar'])->name('alquiler.finalizar');
    Route::post('/equipos-alquilados/importacion', [ListaEquiposAlquiladosController::class, 'import'])->name('alquiler.import');

    //asignar
    // Route::get('/Dotacion', [DotacionController::class, 'index'])->name('Dotacion');
    // //Route::post('/dotacion/registrado', [DotacionController::class, 'dotacion'])->name('dotacion');
    // Route::post('/Dotacion/Registrado', [DotacionController::class, 'dotacion'])->name('Dotacion.Reg');
    Route::get('/Dotacion-Registro', [DotaRegistroController::class, 'index'])->name('Dotacion-Registro');
    Route::post('/Dotacion-Registro/regitrado', [DotaRegistroController::class, 'store'])->name('dotacion.store');
    Route::delete('/Dotacion-Registro/{cargo}/{categoria}', [DotaRegistroController::class, 'destroy']);


    //listas de productos, vehiculos y asignaciones
    // Route::get('/lista-productos', [ListaProductosController::class, 'index'])->name('lis.produc');
    // Route::get('/lista-asignaciones', [ListaAsignadosController::class, 'index'])->name('lis.asignados');
    // Route::get('/lista-vehiculos', [ListaVehiculosController::class, 'index'])->name('lis.vehiculos');

    //mostrar datos en la lista de asignación, productos y vehiculos
    // Route::get('/datos/{id}', [ListaAsignadosController::class, 'datos']);
    // Route::get('/datos-producto/{id}', [ListaProductosController::class, 'datosAsignacion']);
    // Route::get('/datos-vehiculo/{id}', [ListaVehiculosController::class, 'datosVehiculo']);


    //historial computo, registro, import
    Route::get('/historial-computo', [HistorialComputoController::class, 'index'])->name('historial');
    Route::post('/historial-computo/registro', [HistorialComputoController::class, 'store'])->name('historial.store');
    Route::post('/historial-computo/importacion', [HistorialComputoController::class, 'import'])->name('import.historial');
    Route::post('/historial-computo/export', [HistorialComputoController::class, 'export'])->name('historial.export');

    //Novedades
    Route::get('/novedades', [NovedadController::class, 'index'])->name('novedad');
    Route::post('/novedad/registro', [NovedadController::class, 'store'])->name('novedad.store');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware(NoCache::class);
