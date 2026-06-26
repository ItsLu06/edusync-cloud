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
        'user_id',
        'codigo_invitacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'materia_usuario');
    }

    public function progreso()
    {
        return $this->hasMany(Progreso::class);
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}