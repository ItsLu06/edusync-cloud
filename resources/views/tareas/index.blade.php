@extends('layouts.app')

@section('content')
    <h1>{{ $materia->nombre }}</h1>
    <p>{{ $materia->descripcion }}</p>

    <a href="{{ route('materias') }}" class="btn btn-secondary mb-3">Volver a materias</a>

    @if(auth()->user()->rol == 'docente')
        <form action="{{ route('semana.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="materia_id" value="{{ $materia->id }}">
            <div class="input-group">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre de la semana" required>
                <button type="submit" class="btn btn-primary">Agregar semana</button>
            </div>
        </form>
    @endif

    <div id="editarSemanaForm" style="display: none; margin-bottom: 15px; padding: 10px; background: rgba(255,255,255,0.05); border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);">
        <form id="formEditarSemana" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="input-group">
                <input type="text" name="nombre" id="inputEditarSemana" class="form-control" placeholder="Nuevo nombre" required>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="cancelarEdicion()">Cancelar</button>
            </div>
        </form>
    </div>

    @if($semanas->count() > 0)
        <ul class="list-group">
            @foreach($semanas as $semana)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $semana->nombre ?? 'Semana ' . $semana->semana }}</strong>
                        <br><small>{{ $semana->completado ? 'Completado' : 'Pendiente' }}</small>
                    </div>
                    <div>
                        @if(auth()->user()->rol == 'docente')
                            <button class="btn btn-sm btn-warning" onclick="editarSemana({{ $semana->id }}, '{{ addslashes($semana->nombre ?? 'Semana ' . $semana->semana) }}')">Editar</button>
                            <form action="{{ route('semana.destroy', $semana->id) }}" method="POST" style="display: inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        @endif

                        <a href="{{ route('tareas.index', $semana->id) }}" class="btn btn-sm btn-info">Ver tareas</a>

                        <form action="{{ route('progreso.toggle') }}" method="POST" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="materia_id" value="{{ $materia->id }}">
                            <input type="hidden" name="semana" value="{{ $semana->semana }}">
                            <button type="submit" class="btn btn-sm {{ $semana->completado ? 'btn-success' : 'btn-outline-secondary' }}">
                                {{ $semana->completado ? 'Completado' : 'Marcar' }}
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay semanas para esta materia.</p>
    @endif
@endsection

@section('scripts')
<script>
    function editarSemana(id, nombreActual) {
        document.getElementById('editarSemanaForm').style.display = 'block';
        document.getElementById('inputEditarSemana').value = nombreActual;
        document.getElementById('formEditarSemana').action = '/semana/' + id;
    }
    function cancelarEdicion() {
        document.getElementById('editarSemanaForm').style.display = 'none';
    }
</script>
@endsection