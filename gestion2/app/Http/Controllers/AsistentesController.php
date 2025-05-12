<?php

namespace App\Http\Controllers;

use App\Models\Asistentes;
use App\Models\Evento_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AsistentesController extends Controller
{
   
   public function vista_asistentes()
{
    $asistentes = Asistentes::all();
    $eventos = Evento_model::all(); 
    return view('asistentes', compact('asistentes', 'eventos'));
}

 

public function guardar(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:asistentes,email',
        'telefono' => 'nullable|string|max:20',
        'evento_id' => 'required|exists:eventos,id',
        'estado_asistencia' => 'required|in:registrado,asistió,no asistió',
    ]);

    $asistente = new Asistentes();
    $asistente->nombre = $request->nombre;
    $asistente->email = $request->email;
    $asistente->telefono = $request->telefono;
    $asistente->evento_id = $request->evento_id;
    $asistente->estado_asistencia = $request->estado_asistencia;
    $asistente->codigo_qr = Str::uuid();
    $asistente->save();

    return redirect()->route('principal')
        ->with('success', 'Asistente registrado exitosamente');
}
    
public function editar($id)
{
    $asistente = Asistentes::findOrFail($id); 
    $eventos = Evento_model::all(); /
    return view('editar', compact('asistente', 'eventos')); 
}

public function actualizar(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:asistentes,email,' . $id,
        'telefono' => 'nullable|string|max:20',
        'evento_id' => 'required|exists:eventos,id',
        'estado_asistencia' => 'required|in:registrado,asistió,no asistió',
    ]);

    $asistente = Asistentes::findOrFail($id);
    $asistente->update($request->all());

    return redirect()->route('principal')->with('success', 'Asistente actualizado exitosamente');
}
   
    public function eliminar($id)
{
    try {
        $asistente = Asistentes::findOrFail($id);
        $asistente->delete();

        return redirect()->route('vista_asistentes')
            ->with('success', 'Asistente eliminado exitosamente');
    } catch (\Exception $e) {
        return back()->with('error', 'Error al eliminar el asistente: ' . $e->getMessage());
    }
}

    // Mostrar QR (opcional) por el momento
    public function mostrarQR($codigo)
{
    return view('asistente.qr', compact('codigo'));
}
}