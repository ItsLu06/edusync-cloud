<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $fillable = [
        'user_id',
        'materia_id',
        'fecha_emision',
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