<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;
use App\Models\Progreso;

class TareaSeeder extends Seeder
{
    public function run()
    {
        $semanas = Progreso::all();

        foreach ($semanas as $semana) {
            Tarea::create([
                'titulo' => 'Tarea de ' . ($semana->nombre ?? 'Semana ' . $semana->semana),
                'descripcion' => 'Descripción de la tarea para ' . ($semana->nombre ?? 'Semana ' . $semana->semana),
                'prioridad' => 'Media',
                'fecha_vencimiento' => now()->addDays(7),
                'completado' => false,
                'progreso_id' => $semana->id,
            ]);
        }
    }
}