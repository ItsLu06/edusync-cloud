<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progreso;
use App\Models\Certificado;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Contar materias en curso (distintas)
        $materiasEnCurso = Progreso::where('user_id', $user->id)
            ->distinct('materia_id')
            ->count();

        $totalSemanas = 5; // Cada materia tiene 5 semanas

        // Contar semanas completadas
        $completadas = Progreso::where('user_id', $user->id)
            ->where('completado', true)
            ->count();

        // Calcular progreso general
        $progresoGeneral = $materiasEnCurso > 0
            ? round(($completadas / ($materiasEnCurso * $totalSemanas)) * 100)
            : 0;

        // Contar certificados
        $certificados = Certificado::where('user_id', $user->id)->count();

        // Si quieres depurar, descomenta la línea de abajo
        // dd($materiasEnCurso, $progresoGeneral, $certificados);

        return view('dashboard', compact('materiasEnCurso', 'progresoGeneral', 'certificados'));
    }
}