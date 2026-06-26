@extends('layouts.app')

@section('content')
    <h1>Materias</h1>

    <p>Rol del usuario: {{ auth()->user()->rol }}</p>

    @if(auth()->user()->rol == 'docente')
        <form action="{{ route('materias.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre de la materia" required>
                <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
                <input type="text" name="tag" class="form-control" placeholder="Tag (ej: MAT)" required>
                <button type="submit" class="btn btn-primary">Crear materia</button>
            </div>
        </form>
    @endif

    @if(auth()->user()->rol == 'estudiante')
        <form action="{{ route('materias.confirmar') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Ingresa el código de invitación" required>
                <button type="submit" class="btn btn-primary">Verificar código</button>
            </div>
        </form>
    @endif

    @foreach($materias as $materia)
        <div class="card p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $materia->nombre }}</h3>
                    <p>{{ $materia->descripcion }}</p>
                    @if(auth()->user()->rol == 'docente')
                        <small>Código de invitación: <strong>{{ $materia->codigo_invitacion }}</strong></small>
                    @endif
                </div>
                <span class="badge bg-primary">{{ $materia->tag }}</span>
            </div>

            <div class="progress" style="height: 8px;">
                <div class="progress-bar" style="width: {{ $materia->progreso ?? 0 }}%; background: {{ $materia->color ?? '#f5a623' }};"></div>
            </div>
            <span>{{ $materia->progreso ?? 0 }}% completado</span>

            <a href="{{ route('materias.tareas', $materia->id) }}" class="btn btn-sm btn-info mt-2">Ver semanas</a>

            @if(auth()->user()->rol == 'docente')
                <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger mt-2">Eliminar materia</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection