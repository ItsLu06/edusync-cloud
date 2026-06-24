<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progreso;
use App\Models\Materia;
use App\Models\User;

class SemanaSeeder extends Seeder
{
    public function run()
    {
        // Obtener el primer usuario (o el que quieras)
        $user = User::first();

        if (!$user) {
            $this->command->info('No hay usuarios registrados. Crea un usuario primero.');
            return;
        }

        $materias = Materia::all();

        if ($materias->isEmpty()) {
            $this->command->info('No hay materias. Ejecuta MateriaSeeder primero.');
            return;
        }

        foreach ($materias as $materia) {
            for ($i = 1; $i <= 5; $i++) {
                Progreso::firstOrCreate([
                    'user_id' => $user->id,
                    'materia_id' => $materia->id,
                    'semana' => $i,
                ], [
                    'completado' => false,
                ]);
            }
        }

        $this->command->info('Semanas creadas correctamente.');
    }
}