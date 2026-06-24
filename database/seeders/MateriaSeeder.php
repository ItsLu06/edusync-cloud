<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    public function run()
    {
        $materias = [
            [
                'nombre' => 'Estadística',
                'descripcion' => 'Lectura e interpretación de datos para cualquier carrera.',
                'color' => '#2D7D6E',
                'tag' => 'EST'
            ],
            [
                'nombre' => 'Programación',
                'descripcion' => 'Lógica y fundamentos de programación, base para Ingeniería y más.',
                'color' => '#1A2E4A',
                'tag' => 'PRG'
            ],
            [
                'nombre' => 'Comunicación',
                'descripcion' => 'Comunicación escrita y oral para entornos académicos y laborales.',
                'color' => '#B5443D',
                'tag' => 'COM'
            ],
            [
                'nombre' => 'Finanzas',
                'descripcion' => 'Finanzas personales y conceptos básicos para la vida adulta.',
                'color' => '#F5A623',
                'tag' => 'FIN'
            ]
        ];

        foreach ($materias as $materia) {
            Materia::create($materia);
        }
    }
}