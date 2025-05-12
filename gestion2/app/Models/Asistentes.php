<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Evento_model; 

class Asistentes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'evento_id',
        'estado_asistencia',
        'codigo_qr'
    ];

    public function evento()
{
    return $this->belongsTo(Evento_model::class, 'evento_id');

}
}

