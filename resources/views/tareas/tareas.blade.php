@extends('layouts.app')

@section('content')
    <h1>{{ $semana->nombre ?? 'Semana ' . $semana->semana }}</h1>
    <p>Materia: {{ $semana->materia->nombre }}</p>

    <a href="{{ route('materias.tareas', $semana->materia_id) }}" class="btn btn-secondary mb-3">Volver a semanas</a>

    @if(auth()->user()->rol == 'docente')
        <a href="{{ route('tareas.create', $semana->id) }}" class="btn btn-primary mb-3">Agregar tarea</a>
    @endif

    @if($tareas->count() > 0)
        <ul class="list-group">
            @foreach($tareas as $tarea)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $tarea->titulo }}</strong>
                        @if($tarea->descripcion)
                            <br><small>{{ $tarea->descripcion }}</small>
                        @endif
                        <br><small>Prioridad: {{ $tarea->prioridad }}</small>
                        @if($tarea->fecha_vencimiento)
                            <br><small>Vence: {{ $tarea->fecha_vencimiento }}</small>
                        @endif
                        @if($tarea->archivo)
                            <br><small><a href="{{ asset('storage/' . $tarea->archivo) }}" target="_blank">Ver archivo</a></small>
                        @endif
                    </div>
                    <div>
                        <form action="{{ route('tareas.toggle', $tarea->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $tarea->completado ? 'btn-success' : 'btn-outline-secondary' }}">
                                {{ $tarea->completado ? 'Completado' : 'Marcar' }}
                            </button>
                        </form>

                        @if(auth()->user()->rol == 'docente')
                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display: inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay tareas en esta semana.</p>
    @endif
@endsection