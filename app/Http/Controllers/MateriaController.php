<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Progreso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriaController extends Controller
{
    public function webIndex()
    {
        $user = auth()->user();

        // Depuración: ver datos del usuario
        // dd($user);

        if ($user->rol == 'docente') {
            $materias = Materia::where('user_id', $user->id)->get();
        } else {
            $materias = $user->materiasInscritas;
        }

        // Depuración: ver materias obtenidas
        //dd($materias);

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

    public function store(Request $request)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'color' => 'nullable|string',
            'tag' => 'required|string|max:5',
        ]);

        $materia = Materia::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'tag' => $request->tag,
            'user_id' => auth()->id(),
            'codigo_invitacion' => Str::upper(Str::random(8)),
        ]);

        return redirect()->route('materias')->with('success', 'Materia creada. Código de invitación: ' . $materia->codigo_invitacion);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['message' => 'Materia no encontrada'], 404);
        }

        $materia->update($request->all());
        return redirect()->route('materias')->with('success', 'Materia actualizada');
    }

    public function destroy($id)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['message' => 'Materia no encontrada'], 404);
        }

        $materia->delete();
        return redirect()->route('materias')->with('success', 'Materia eliminada');
    }

    public function confirmar(Request $request)
    {
        $codigo = $request->query('codigo');

        $materia = Materia::where('codigo_invitacion', $codigo)->first();

        if (!$materia) {
            return redirect()->route('dashboard')->with('error', 'Código de invitación inválido.');
        }

        return view('materias.confirmar', compact('materia'));
    }

    public function confirmarStore(Request $request)
    {
        $codigo = $request->query('codigo');

        $materia = Materia::where('codigo_invitacion', $codigo)->first();

        if (!$materia) {
            return redirect()->route('dashboard')->with('error', 'Código de invitación inválido.');
        }

        if (auth()->user()->materiasInscritas()->where('materia_id', $materia->id)->exists()) {
            return redirect()->route('dashboard')->with('error', 'Ya estás inscrito en esta materia.');
        }

        auth()->user()->materiasInscritas()->attach($materia->id);

        return redirect()->route('dashboard')->with('success', 'Te has unido a la materia: ' . $materia->nombre);
    }

    // API Methods
    public function index()
    {
        return response()->json(Materia::all(), 200);
    }

    public function show($id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['message' => 'Materia no encontrada'], 404);
        }
        return response()->json($materia, 200);
    }
}