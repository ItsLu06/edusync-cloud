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
    ];

    protected $hidden = [
        'password',
        'remember_token',
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