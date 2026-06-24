@extends('layouts.app')

@section('content')
    <h1>Nueva tarea</h1>
    <p>Semana: {{ $semana->nombre ?? 'Semana ' . $semana->semana }}</p>

    <form action="{{ route('tareas.store', $semana->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Prioridad</label>
            <select name="prioridad" class="form-control">
                <option value="Baja">Baja</option>
                <option value="Media" selected>Media</option>
                <option value="Alta">Alta</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha de vencimiento</label>
            <input type="date" name="fecha_vencimiento" class="form-control">
        </div>
        <div class="mb-3">
            <label>Archivo adjunto</label>
            <input type="file" name="archivo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('tareas.index', $semana->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection