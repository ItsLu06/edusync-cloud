@extends('layouts.app')

@section('content')
    <h1>Materias</h1>

    @foreach($materias as $materia)
        <div class="card p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $materia->nombre }}</h3>
                    <p>{{ $materia->descripcion }}</p>
                </div>
                <span class="badge bg-primary">{{ $materia->tag }}</span>
            </div>

            <div class="progress" style="height: 8px;">
                <div class="progress-bar" style="width: {{ $materia->progreso ?? 0 }}%; background: {{ $materia->color ?? '#f5a623' }};"></div>
            </div>
            <span>{{ $materia->progreso ?? 0 }}% completado</span>

            <!-- Botón corregido -->
            <a href="{{ route('materias.tareas', $materia->id) }}" class="btn btn-sm btn-info mt-2">
                Ver semanas
            </a>
        </div>
    @endforeach
@endsection