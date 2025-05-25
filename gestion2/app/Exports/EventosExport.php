<?php

namespace App\Exports;

use App\Models\Evento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventosExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Evento::withCount('asistentes')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Fecha',
            'Ubicación',
            'Tipo',
            'Estado',
            'Asistentes'
        ];
    }

    public function map($evento): array
    {
        return [
            $evento->nombre_evento,
            $evento->fecha_inicio->format('d/m/Y'),
            $evento->ubicacion,
            $evento->tipo_evento,
            ucfirst($evento->estado),
            $evento->asistentes_count
        ];
    }
}