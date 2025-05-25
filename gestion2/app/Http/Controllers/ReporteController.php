<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Asistente;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventosExport;
use App\Exports\AsistentesExport;
use Carbon\Carbon;

class ReporteController extends Controller
{
    
    public function eventosPDF($tipo = null)
    {
        $query = Evento::query();
        
        if($tipo) {
            $query->where('tipo_evento', $tipo);
        }

        $eventos = $query->with('asistentes')->get();
        $fecha = Carbon::now()->format('d-m-Y');
        
        $pdf = Pdf::loadView('reportes.eventos-pdf', compact('eventos', 'fecha'));
        return $pdf->download("reporte-eventos-{$fecha}.pdf");
    }

    
    public function eventosExcel()
    {
        return Excel::download(new EventosExport, 'eventos.xlsx');
    }

    
    public function asistentesPDF($eventoId)
    {
        $evento = Evento::with('asistentes')->findOrFail($eventoId);
        $fecha = Carbon::now()->format('d-m-Y');
        
        $pdf = Pdf::loadView('reportes.asistentes-pdf', compact('evento', 'fecha'));
        return $pdf->download("asistentes-{$evento->nombre}-{$fecha}.pdf");
    }

   
    public function asistentesExcel()
    {
        return Excel::download(new AsistentesExport, 'asistentes.xlsx');
    }
}