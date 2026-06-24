@extends('layouts.app')

@section('content')
    <h1>Editar tarea</h1>

    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $tarea->titulo }}" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $tarea->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label>Prioridad</label>
            <select name="prioridad" class="form-control">
                <option value="Baja" {{ $tarea->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                <option value="Media" {{ $tarea->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                <option value="Alta" {{ $tarea->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha de vencimiento</label>
            <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $tarea->fecha_vencimiento }}">
        </div>
        <div class="mb-3">
            <label>Archivo adjunto</label>
            <input type="file" name="archivo" class="form-control">
            @if($tarea->archivo)
                <small>Archivo actual: <a href="{{ asset('storage/' . $tarea->archivo) }}" target="_blank">Ver</a></small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tareas.index', $tarea->progreso_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection