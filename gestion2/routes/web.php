<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AsistentesController;

Route::get('/', [EventoController::class, 'principal'])->name('principal');
Route::get('/evento', [EventoController::class, 'index'])->name('evento.index');
Route::post('/evento', [EventoController::class, 'guardar'])->name('evento.guardar');

Route::delete('{id}', [EventoController::class, 'eliminar'])->name('evento.eliminar');



// Ruta para mostrar el formulario de edición
//Route::get('/evento{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');

// Ruta para procesar la actualización
//Route::put('/evento/actualizar/{id}', [EventoController::class, 'update'])->name('eventos.update');

// Para mostrar el formulario de edición
Route::get('/evento/{evento}/edit', [EventoController::class, 'edit'])->name('evento.edit');

// Para procesar la actualización
Route::put('/evento/{id}', [EventoController::class, 'update'])->name('evento.update');
//Route::delete('/evento/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');




// Rutas para Asistentes

// Mostrar la vista principal de asistentes
//Route::get('/asistentes/ver', [AsistentesController::class, 'vista_asistentes'])->name('vista_asistentes');

// Mostrar formulario de creación

Route::get('/asistentes', [AsistentesController::class, 'vista_asistentes'])->name('asistentes.index');

Route::post('/asistentes', [AsistentesController::class, 'guardar'])->name('asistentes.guardar');

// Mostrar formulario de edición
Route::get('/asistentes/{id}/editar', [AsistentesController::class, 'edit'])->name('asistentes.edit');
// Procesar actualización
Route::put('/asistente/{id}', [AsistentesController::class, 'actualizar'])->name('asistente.actualizar');

// Eliminar asistente
Route::delete('/asistentes/{id}', [AsistentesController::class, 'eliminar'])->name('asistentes.eliminar');

// Vista QR (opcional)
Route::get('/qr/{codigo}', function($codigo) {
    return view('asistente.qr', compact('codigo'));
})->name('asistente.qr');


// Vista de asistentes

