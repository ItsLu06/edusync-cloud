<?php

namespace App\Http\Controllers;

use App\Models\Progreso;
use Illuminate\Http\Request;

class SemanaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'nombre' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $ultimaSemana = Progreso::where('user_id', $user->id)
                                ->where('materia_id', $request->materia_id)
                                ->max('semana');

        $nuevaSemana = $ultimaSemana + 1;

        Progreso::create([
            'user_id' => $user->id,
            'materia_id' => $request->materia_id,
            'semana' => $nuevaSemana,
            'nombre' => $request->nombre,
            'completado' => false,
        ]);

        return redirect()->back()->with('success', 'Semana agregada correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $semana = Progreso::where('id', $id)
                          ->where('user_id', auth()->id())
                          ->firstOrFail();

        $semana->nombre = $request->nombre;
        $semana->save();

        return redirect()->back()->with('success', 'Nombre de semana actualizado');
    }

    public function destroy($id)
    {
        $semana = Progreso::where('id', $id)
                          ->where('user_id', auth()->id())
                          ->firstOrFail();

        $semana->delete();

        return redirect()->back()->with('success', 'Semana eliminada');
    }
}