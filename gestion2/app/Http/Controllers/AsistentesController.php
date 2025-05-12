<?php

namespace App\Http\Controllers;

use App\Models\Asistentes;
use App\Models\Evento_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AsistentesController extends Controller
{
    // Mostrar lista de asistentes con sus eventos (vista principal)
    public function vista_asistentes()
{
    $asistentes = \App\Models\Asistentes::all();
    $asistentes = Asistentes::with('evento')->get();
    return view('asistentes.vista_asistentes', compact('asistentes'));
}


    // Mostrar formulario de creación de asistente
    public function create()
    {
        $asistentes = Asistentes::all();
        $eventos = Evento_model::all(); // Obtén todos los eventos
        return view('asistentes.asistentes', compact('eventos'));
    }

    // Guardar nuevo asistente en la base de datos
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asistentes,email',
            'telefono' => 'nullable|string|max:20',
            'evento_id' => 'required|exists:eventos,id',
            'estado_asistencia' => 'required|in:registrado,asistió,no asistió',
        ]);

        try {
            DB::beginTransaction();
            $validated['codigo_qr'] = Str::uuid();
            Asistentes::create($validated);
            DB::commit();

            return redirect()->route('vista_asistentes')
                ->with('success', 'Asistente registrado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al guardar el asistente: ' . $e->getMessage());
        }
    }

    // Mostrar formulario de edición de asistente
    public function edit($id)
    {
        $asistente = Asistentes::findOrFail($id);
        $eventos = Evento_model::all();
        return view('asistentes.edit', compact('asistente', 'eventos'));
    }

    // Procesar actualización del asistente
    public function actualizar(Request $request, $id)
    {
        $asistente = Asistentes::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asistentes,email,' . $asistente->id,
            'telefono' => 'nullable|string|max:20',
            'evento_id' => 'required|exists:eventos,id',
            'estado_asistencia' => 'required|in:registrado,asistió,no asistió',
        ]);

        try {
            DB::beginTransaction();
            $asistente->update($validated);
            DB::commit();

            return redirect()->route('vista_asistentes')
                ->with('success', 'Asistente actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al actualizar el asistente: ' . $e->getMessage());
        }
    }

    // Eliminar asistente
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
}
