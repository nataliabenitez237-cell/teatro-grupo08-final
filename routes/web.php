<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminConsultaController;
use App\Http\Controllers\AdminEventoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\AdminTallerController;
use App\Http\Controllers\TallerController;

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/', [EventoController::class, 'index'])->name('home');

Route::get('/eventos/proximos', [EventoController::class, 'proximos'])
    ->name('eventos.proximos');

Route::get('/eventos/{id}', [EventoController::class, 'show'])
    ->name('eventos.show');

Route::get('/buscar', [EventoController::class, 'buscar'])
    ->name('eventos.buscar');

Route::get('/eventos', [EventoController::class, 'todos'])
    ->name('eventos.todos');   

Route::view('/quienes-somos', 'quienes-somos')->name('quienes-somos');
Route::view('/boleteria', 'boleteria')->name('boleteria');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/terminos', 'terminos')->name('terminos');

/* TALLERES */
Route::get('/talleres', [TallerController::class, 'index'])
    ->name('talleres.index');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/registro', [AuthController::class, 'formularioRegistro'])
    ->name('registro');

Route::post('/registro', [AuthController::class, 'registrar']);

Route::get('/login', [AuthController::class, 'formularioLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'autenticar']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| CONSULTAS (PÚBLICO)
|--------------------------------------------------------------------------
*/

Route::get('/consultas', [ConsultaController::class, 'showForm'])
    ->name('consultas.form');

Route::post('/consultas', [ConsultaController::class, 'enviar'])
    ->name('consultas.enviar');

Route::post('/contacto', [ContactoController::class, 'enviar'])
    ->name('contacto.enviar');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'rol:admin'])
    ->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    /* EVENTOS ADMIN */
    Route::resource('eventos', AdminEventoController::class)
        ->names('admin.eventos');

        // Restaurar evento eliminado
    Route::post('/eventos/{id}/restore', [AdminEventoController::class, 'restore'])
         ->name('admin.eventos.restore');


         // Restaurar taller eliminado (si también lo necesitas)
    Route::post('/talleres/{id}/restore', [AdminTallerController::class, 'restore'])
         ->name('admin.talleres.restore');

    /* TALLERES ADMIN */
    Route::get('/talleres', [AdminTallerController::class, 'index'])
        ->name('admin.talleres.index');

    Route::get('/talleres/create', [AdminTallerController::class, 'create'])
        ->name('admin.talleres.create');

    Route::post('/talleres', [AdminTallerController::class, 'store'])
        ->name('admin.talleres.store');

    Route::get('/talleres/{id}/edit', [AdminTallerController::class, 'edit'])
        ->name('admin.talleres.edit');

    Route::put('/talleres/{id}', [AdminTallerController::class, 'update'])
        ->name('admin.talleres.update');

    Route::delete('/talleres/{id}', [AdminTallerController::class, 'destroy'])
        ->name('admin.talleres.destroy');

    Route::post('/talleres/{id}/restore', [AdminTallerController::class, 'restore'])
        ->name('admin.talleres.restore');

    Route::get('/talleres/{id}/inscriptos', [AdminTallerController::class, 'inscriptos'])
        ->name('admin.talleres.inscriptos');

    /* CONSULTAS ADMIN */
    Route::get('/consultas', [AdminConsultaController::class, 'index'])
        ->name('admin.consultas.index');

    Route::patch('/consultas/{id}/leida', [AdminConsultaController::class, 'marcarLeida'])
        ->name('admin.consultas.leida');

    Route::delete('/consultas/{id}', [AdminConsultaController::class, 'destroy'])
        ->name('admin.consultas.destroy');

      /* USUARIOS */
    Route::get('/usuarios', [AdminController::class, 'usuarios'])
        ->name('admin.usuarios.index');

        // Crear usuario (mostrar formulario)
    Route::get('/usuarios/create', [AdminController::class, 'createUsuario'])
         ->name('admin.usuarios.create');

          // Guardar usuario
    Route::post('/usuarios', [AdminController::class, 'storeUsuario'])
          ->name('admin.usuarios.store');

         // Editar usuario
    Route::get('/usuarios/{id}/edit', [AdminController::class, 'editUsuario'])
           ->name('admin.usuarios.edit');

           // Actualizar usuario
    Route::put('/usuarios/{id}', [AdminController::class, 'updateUsuario'])
           ->name('admin.usuarios.update');

           // Eliminar usuario
    Route::delete('/usuarios/{id}', [AdminController::class, 'destroyUsuario'])
            ->name('admin.usuarios.destroy');

       /* REPORTES */
    Route::get('/reportes/ventas', [ReporteController::class, 'ventas'])
        ->name('admin.reportes.ventas');

    /* COMPRAS */
    Route::get('/compras', [AdminController::class, 'comprasPendientes'])
        ->name('admin.compras.index');
});


/*
|--------------------------------------------------------------------------
| CLIENTE
|--------------------------------------------------------------------------
*/

Route::prefix('cliente')
    ->middleware(['auth', 'rol:cliente'])
    ->group(function () {

    Route::get('/', [ClienteController::class, 'index'])
        ->name('cliente.dashboard');

    /* HISTORIAL DE COMPRAS */
    Route::get('/historial', [ClienteController::class, 'historial'])
        ->name('cliente.historial');

    /* PDF DE LA COMPRA */
    Route::get('/compras/{id}/pdf', [ClienteController::class, 'pdfCompra'])
        ->name('cliente.compras.pdf');

    /* CANCELAR COMPRA */
    Route::post('/compras/{id}/cancelar', [ClienteController::class, 'cancelarCompra'])
        ->name('cliente.compras.cancelar');

    /* TALLERES DEL CLIENTE */
    Route::get('/talleres', [ClienteController::class, 'talleres'])
        ->name('cliente.talleres');

    Route::delete('/talleres/{id}/cancelar', [TallerController::class, 'cancelarInscripcion'])
        ->name('cliente.talleres.cancelar');

    /* PERFIL */
    Route::get('/perfil', [ClienteController::class, 'perfil'])
        ->name('cliente.perfil');

    Route::post('/perfil', [ClienteController::class, 'actualizarPerfil'])
        ->name('cliente.perfil.update');
});


/*
|--------------------------------------------------------------------------
| CARRITO
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'rol:cliente'])->group(function () {

    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');

    Route::post('/carrito/agregar-evento/{id}', [CarritoController::class, 'agregarEvento'])
        ->name('carrito.agregar.evento');

    Route::get('/carrito', [CarritoController::class, 'verCarrito'])
        ->name('carrito.ver');

    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
        ->name('carrito.eliminar');

    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])
        ->name('carrito.vaciar');

    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizarCantidad'])
        ->name('carrito.actualizar');

    Route::post('/carrito/finalizar', [CarritoController::class, 'finalizarCompra'])
        ->name('carrito.finalizar');

    /* CONFIRMAR COMPRA */
    Route::post('/compra/{id}/confirmar', [CompraController::class, 'confirmarPago'])
        ->name('compra.confirmar');
});


/*
|--------------------------------------------------------------------------
| PÁGINA EN CONSTRUCCIÓN (siempre al final)
|--------------------------------------------------------------------------
*/

Route::get('/en-construccion', function () {
    return view('en-construccion');
})->name('en-construccion');