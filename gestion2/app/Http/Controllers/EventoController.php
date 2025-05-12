<?php

namespace App\Http\Controllers;

use App\Models\Evento_model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    public function principal()
    {
        $eventos = Evento_model::all();
        $usuarios = User::all();
        $asistentes = \App\Models\Asistentes::with('evento')->get();
        return view('principal', compact('eventos', 'asistentes'));
    }

    public function index()
    {
        $eventos = Evento_model::all();
        $usuarios = User::all();
        return view('index', compact('eventos', 'usuarios'));
    }

     public function evento()
    {
        return $this->belongsTo(Evento_model::class,'evento_id');
    }   


    public function create()
    {
        $usuarios = User::all();
        return view('evento.create', compact('usuarios'));
    }


    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|in:activo,finalizado,cancelado',
            'tipo_evento' => 'required|string|max:255',
        ]);

        Evento_model::create($validated);

        return redirect()->route('principal')->with('success', 'Evento creado exitosamente');
    }

    public function edit(Evento_model $evento)
    {
        $usuarios = User::all();
        return view('evento.edit', compact('evento', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $evento = Evento_model::findOrFail($id);

        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|in:activo,finalizado,cancelado',
            'tipo_evento' => 'required|string|max:255',
        ]);

        $evento->update($validated);

        return redirect()->route('evento.index')->with('success', 'Evento actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        try {
            $evento = Evento_model::findOrFail($id);
            $evento->delete();
            return redirect()->route('evento.index')->with('success', 'Evento eliminado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el evento: ' . $e->getMessage());

    
        }

    }
}

