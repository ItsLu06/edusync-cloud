<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    protected $table = 'progreso';

    protected $fillable = [
        'user_id',
        'materia_id',
        'semana',
        'nombre',
        'completado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}