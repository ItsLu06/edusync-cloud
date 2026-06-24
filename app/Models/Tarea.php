<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'prioridad',
        'fecha_vencimiento',
        'archivo',
        'completado',
        'progreso_id',
    ];

    public function progreso()
    {
        return $this->belongsTo(Progreso::class);
    }
}