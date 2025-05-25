<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AsistentesController;
use App\Http\Controllers\AuthController;



Route::resource('admin/dashboard', AdminController::class)
    ->middleware(['auth', 'role:admin']); 


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [EventoController::class, 'principal'])->name('principal');
Route::get('/evento', [EventoController::class, 'index'])->name('evento.index');
Route::post('/evento', [EventoController::class, 'guardar'])->name('evento.guardar');
Route::get('/evento/{id}', [EventoController::class, 'edit'])->name('evento.edit');
Route::put('/evento/{id}', [EventoController::class, 'update'])->name('evento.update');
Route::delete('{id}', [EventoController::class, 'eliminar'])->name('evento.eliminar');
Route::get('/xavi', [XavipController::class, 'xavi'])->name('xavi');




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    return 'Bienvenido al dashboard, estás autenticado.';
})->middleware('auth');




Route::put('/evento/{id}', [EventoController::class, 'update'])->name('evento.update');
//Route::delete('/evento/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');

Route::get('/eventos/exportar-excel', [EventoController::class, 'exportarExcel'])->name('eventos.export.excel');
Route::get('/eventos/exportar-pdf', [EventoController::class, 'exportarPDF'])->name('eventos.export.pdf');





//Route::get('/asistentes/ver', [AsistentesController::class, 'vista_asistentes'])->name('vista_asistentes');



Route::get('/asistentes', [AsistentesController::class, 'vista_asistentes'])->name('asistentes.index');

Route::post('/asistentes', [AsistentesController::class, 'guardar'])->name('asistentes.guardar');


Route::get('/asistentes/{id}/editar', [AsistentesController::class, 'editar'])->name('asistentes.edit');

Route::put('/asistentes/{id}', [AsistentesController::class, 'actualizar'])->name('asistentes.actualizar');


Route::delete('/asistentes/{id}', [AsistentesController::class, 'eliminar'])->name('asistentes.eliminar');

Route::get('/qr/{codigo}', function($codigo) {
    return view('asistente.qr', compact('codigo'));
})->name('asistente.qr');

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