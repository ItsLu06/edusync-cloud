<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Progreso;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index($progresoId)
    {
        $semana = Progreso::findOrFail($progresoId);
        $tareas = Tarea::where('progreso_id', $progresoId)->get();

        return view('tareas.tareas', compact('semana', 'tareas'));
    }

    public function create($progresoId)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $semana = Progreso::where('id', $progresoId)
                          ->where('user_id', auth()->id())
                          ->firstOrFail();

        return view('tareas.create', compact('semana'));
    }

    public function store(Request $request, $progresoId)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad' => 'required|in:Baja,Media,Alta',
            'fecha_vencimiento' => 'nullable|date',
            'archivo' => 'nullable|file|max:2048',
        ]);

        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('tareas', 'public');
        }

        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'archivo' => $archivoPath,
            'progreso_id' => $progresoId,
        ]);

        return redirect()->route('tareas.index', $progresoId)->with('success', 'Tarea creada');
    }

    public function edit($id)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $tarea = Tarea::where('id', $id)
                      ->whereHas('progreso', function ($query) {
                          $query->where('user_id', auth()->id());
                      })
                      ->firstOrFail();

        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $tarea = Tarea::where('id', $id)
                      ->whereHas('progreso', function ($query) {
                          $query->where('user_id', auth()->id());
                      })
                      ->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad' => 'required|in:Baja,Media,Alta',
            'fecha_vencimiento' => 'nullable|date',
            'archivo' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('tareas', 'public');
            $tarea->archivo = $archivoPath;
        }

        $tarea->update($request->except('archivo'));

        return redirect()->route('tareas.index', $tarea->progreso_id)->with('success', 'Tarea actualizada');
    }

    public function destroy($id)
    {
        if (auth()->user()->rol !== 'docente') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $tarea = Tarea::where('id', $id)
                      ->whereHas('progreso', function ($query) {
                          $query->where('user_id', auth()->id());
                      })
                      ->firstOrFail();

        $progresoId = $tarea->progreso_id;
        $tarea->delete();

        return redirect()->route('tareas.index', $progresoId)->with('success', 'Tarea eliminada');
    }

    public function toggle($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->completado = !$tarea->completado;
        $tarea->save();

        return redirect()->back()->with('success', 'Estado actualizado');
    }
}