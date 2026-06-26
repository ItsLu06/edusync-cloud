<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con materias creadas (docente)
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    // Relación con materias inscritas (estudiante)
    public function materiasInscritas()
    {
        return $this->belongsToMany(Materia::class, 'materia_usuario');
    }

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