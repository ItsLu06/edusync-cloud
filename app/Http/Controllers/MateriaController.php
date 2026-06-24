<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Progreso; // ← AGREGAR ESTA LÍNEA
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    // WebIndex
    public function webIndex()
    {
        $user = auth()->user();
        $materias = Materia::all();

        foreach ($materias as $materia) {
            $totalSemanas = Progreso::where('user_id', $user->id)
                                    ->where('materia_id', $materia->id)
                                    ->count();

            $completadas = Progreso::where('user_id', $user->id)
                                   ->where('materia_id', $materia->id)
                                   ->where('completado', true)
                                   ->count();

            $materia->progreso = $totalSemanas > 0 ? round(($completadas / $totalSemanas) * 100) : 0;
        }

        return view('materias', compact('materias'));
    }

    // Listar todas las materias (API)
    public function index()
    {
        return response()->json(Materia::all(), 200);
    }

    // Mostrar una materia (API)
    public function show($id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['message' => 'Materia no encontrada'], 404);
        }
        return response()->json($materia, 200);
    }

    // Crear una materia (API)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'color' => 'nullable|string',
            'tag' => 'required|string|max:5',
        ]);

        $materia = Materia::create($request->all());
        return response()->json($materia, 201);
    }

    // Actualizar materia (API)
    public function update(Request $request, $id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['message' => 'Materia no encontrada'], 404);
        }

        $materia->update($request->all());
        return response()->json($materia, 200);
    }

    // Eliminar materia (API)
    public function destroy($id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['message' => 'Materia no encontrada'], 404);
        }

        $materia->delete();
        return response()->json(['message' => 'Materia eliminada'], 200);
    }
}