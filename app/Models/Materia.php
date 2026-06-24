<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'color',
        'tag',
    ];

    // Relación con progreso
    public function progreso()
    {
        return $this->hasMany(Progreso::class);
    }

    // Relación con certificados
    public function certificados()
    {
        return $this->hasMany(Certificado::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}