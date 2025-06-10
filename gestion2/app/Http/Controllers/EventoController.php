<?php

namespace App\Http\Controllers;

use App\Models\Evento_model;
use App\Models\Asistentes;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventosExport;
use Barryvdh\DomPDF\Facade\Pdf;

class EventoController extends Controller
{
    public function principal()
    {
        $eventos = Evento_model::all();
        $asistentes = Asistentes::with('evento')->get();
        return view('principal', compact('eventos', 'asistentes'));
    }

    public function index()
    {
        $eventos = Evento_model::all();
        $usuarios = User::all();
        return view('index', compact('eventos', 'usuarios'));
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

        $evento = Evento_model::create($validated);

        // Generar QR
        $contenido = "Evento: {$evento->nombre_evento}\nDescripción: {$evento->descripcion}\nFecha: {$evento->fecha_inicio}";
        $qr = new QrCode($contenido);
        $writer = new PngWriter();
        $result = $writer->write($qr);
        $nombreArchivo = 'qr_evento_'.$evento->id.'.png';
        Storage::put("public/qrcodes/{$nombreArchivo}", $result->getString());
        $evento->codigo_qr = $nombreArchivo;
        $evento->save();

        return redirect()->route('principal')->with('success', 'Evento creado exitosamente');
    }

    public function edit($id)
    {
        $evento = Evento_model::findOrFail($id);
        return view('edit', compact('evento'));

    }

    public function update(Request $request, $id)
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

        $evento = Evento_model::findOrFail($id);
        $evento->update($validated);

        return redirect()->route('principal')->with('success', 'Evento actualizado exitosamente');
    }

    public function eliminar($id)
    {
        try {
            $evento = Evento_model::findOrFail($id);
            $evento->delete();
            return redirect()->route('principal')->with('success', 'Evento eliminado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el evento: '.$e->getMessage());
        }
    }

    public function exportarExcel()
    {
        return Excel::download(new EventosExport(), 'eventos.xlsx');
    }

    public function exportarPDF()
    {
        $eventos = Evento_model::all();
        $fecha = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('eventos_pdf', compact('eventos', 'fecha'));
        return $pdf->download("reporte-eventos-{$fecha}.pdf");
    }
}














