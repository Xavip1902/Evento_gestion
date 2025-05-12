<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Evento_model extends Model
{
     use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
       'nombre_evento',
    'descripcion',
    'fecha_inicio',
    'fecha_fin',
    'ubicacion',
    'organizador_id',
    'estado',
    'tipo_evento'
];

protected $casts = [
    'fecha_inicio' => 'datetime',
    'fecha_fin' => 'datetime',
];

    public function organizador()
    {
        return $this->belongsTo(User::class, 'organizador_id');
    }

    public function asistentes()
    {
        return $this->hasMany(Asistente::class);
    }
}

