<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Progreso;
use App\Models\Certificado;
use Illuminate\Http\Request;

class ProgresoController extends Controller
{
    // API
    public function index(Request $request)
    {
        $progreso = Progreso::where('user_id', $request->user()->id)->get();
        return response()->json($progreso, 200);
    }

    // API toggle
    public function toggle(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'semana' => 'required|integer|min:0',
        ]);

        $progreso = Progreso::where([
            'user_id' => $request->user()->id,
            'materia_id' => $request->materia_id,
            'semana' => $request->semana,
        ])->first();

        if ($progreso) {
            $progreso->completado = !$progreso->completado;
            $progreso->save();
        } else {
            $progreso = Progreso::create([
                'user_id' => $request->user()->id,
                'materia_id' => $request->materia_id,
                'semana' => $request->semana,
                'completado' => true,
            ]);
        }

        $totalSemanas = 5;
        $completadas = Progreso::where([
            'user_id' => $request->user()->id,
            'materia_id' => $request->materia_id,
            'completado' => true,
        ])->count();

        if ($completadas >= $totalSemanas) {
            $existe = Certificado::where([
                'user_id' => $request->user()->id,
                'materia_id' => $request->materia_id,
            ])->exists();

            if (!$existe) {
                Certificado::create([
                    'user_id' => $request->user()->id,
                    'materia_id' => $request->materia_id,
                    'fecha_emision' => now(),
                ]);
            }
        }

        return response()->json($progreso, 200);
    }

    // Web toggle
    public function toggleWeb(Request $request)
    {
        $user = auth()->user();
        $materiaId = $request->materia_id;
        $semana = $request->semana;

        $progreso = Progreso::where([
            'user_id' => $user->id,
            'materia_id' => $materiaId,
            'semana' => $semana,
        ])->first();

        if ($progreso) {
            $progreso->completado = !$progreso->completado;
            $progreso->save();
        } else {
            Progreso::create([
                'user_id' => $user->id,
                'materia_id' => $materiaId,
                'semana' => $semana,
                'completado' => true,
            ]);
        }

        $totalSemanas = 5;
        $completadas = Progreso::where([
            'user_id' => $user->id,
            'materia_id' => $materiaId,
            'completado' => true,
        ])->count();

        if ($completadas >= $totalSemanas) {
            $existe = Certificado::where([
                'user_id' => $user->id,
                'materia_id' => $materiaId,
            ])->exists();

            if (!$existe) {
                Certificado::create([
                    'user_id' => $user->id,
                    'materia_id' => $materiaId,
                    'fecha_emision' => now(),
                ]);
            }
        }

        return redirect()->route('materias')->with('success', 'Progreso actualizado');
    }

    // Mostrar semanas de una materia
    public function showSemanas($materiaId)
    {
        $materia = Materia::findOrFail($materiaId);

        // Obtener semanas de la materia, sin importar el usuario
        $semanas = Progreso::where('materia_id', $materiaId)
                        ->orderBy('semana')
                        ->get();

        return view('tareas.index', compact('materia', 'semanas'));
    }
}