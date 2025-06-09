<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AsistentesController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\HomeController;

// Redirección de raíz

// Redirige la ruta raíz ("/") al login

Route::get('/', [EventoController::class, 'principal'])->name('principal');


// Rutas Públicas
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas Protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', function () {
        return redirect()->route('principal');
    });
    
    // Eventos (en singular como lo tenías)
    Route::get('/evento', [EventoController::class, 'index'])->name('evento.index');
    Route::post('/evento', [EventoController::class, 'guardar'])->name('evento.guardar');
    Route::get('/evento/{id}', [EventoController::class, 'edit'])->name('evento.edit');
    Route::put('/evento/{id}', [EventoController::class, 'update'])->name('evento.update');
    Route::delete('/evento/{id}', [EventoController::class, 'eliminar'])->name('evento.eliminar');
    
    // Exportaciones (aquí dejé el plural 'eventos' como en tu versión original)
    Route::get('/eventos/exportar-excel', [EventoController::class, 'exportarExcel'])->name('eventos.export.excel');
    Route::get('/eventos/exportar-pdf', [EventoController::class, 'exportarPDF'])->name('eventos.export.pdf');
    
    // Asistentes
    Route::get('/asistentes', [AsistentesController::class, 'vista_asistentes'])->name('asistentes.index');
    Route::post('/asistentes', [AsistentesController::class, 'guardar'])->name('asistentes.guardar');
    Route::get('/asistentes/{id}/editar', [AsistentesController::class, 'editar'])->name('asistentes.edit');
    Route::put('/asistentes/{id}', [AsistentesController::class, 'actualizar'])->name('asistentes.actualizar');
    Route::delete('/asistentes/{id}', [AsistentesController::class, 'eliminar'])->name('asistentes.eliminar');
    Route::get('/qr/{codigo}', function($codigo) {
        return view('asistente.qr', compact('codigo'));
    })->name('asistente.qr');
    
    // Reportes
    Route::prefix('reportes')->group(function () {
        Route::prefix('eventos')->group(function () {
            Route::get('/pdf/{tipo?}', [ReporteController::class, 'eventosPDF'])
                ->name('reportes.eventos.pdf');
            Route::get('/excel', [ReporteController::class, 'eventosExcel'])
                ->name('reportes.eventos.excel');
        });
        
        Route::prefix('asistentes')->group(function () {
            Route::get('/{evento}/pdf', [ReporteController::class, 'asistentesPDF'])
                ->name('reportes.asistentes.pdf');
            Route::get('/excel', [ReporteController::class, 'asistentesExcel'])
                ->name('reportes.asistentes.excel');
        });
    });
    
    // Ruta adicional que tenías
    Route::get('/xavi', [XavipController::class, 'xavi'])->name('xavi');
});