@extends('layouts.app')

@section('content')
    <h1>{{ $materia->nombre }}</h1>
    <p>{{ $materia->descripcion }}</p>

    <a href="{{ route('materias') }}" class="btn btn-secondary mb-3">Volver a materias</a>

    <!-- Formulario para agregar nueva semana -->
    <form action="{{ route('semana.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="hidden" name="materia_id" value="{{ $materia->id }}">
        <div class="input-group">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre de la semana" required>
            <button type="submit" class="btn btn-primary">Agregar semana</button>
        </div>
    </form>

    <!-- Formulario para editar semana (oculto por defecto) -->
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
                <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); color: #f0f0f0;">
                    <div>
                        <strong>{{ $semana->nombre ?? 'Semana ' . $semana->semana }}</strong>
                        <br><small>{{ $semana->completado ? 'Completado' : 'Pendiente' }}</small>
                    </div>
                    <div>
                        <!-- Botón Editar con onclick directo -->
                        <button class="btn btn-sm btn-warning" onclick="editarSemana({{ $semana->id }}, '{{ addslashes($semana->nombre ?? 'Semana ' . $semana->semana) }}')" style="color: #0d0d0d; font-weight: 600;">
                            Editar
                        </button>

                        <a href="{{ route('tareas.index', $semana->id) }}" class="btn btn-sm btn-info">Ver tareas</a>

                        <form action="{{ route('progreso.toggle') }}" method="POST" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="materia_id" value="{{ $materia->id }}">
                            <input type="hidden" name="semana" value="{{ $semana->semana }}">
                            <button type="submit" class="btn btn-sm {{ $semana->completado ? 'btn-success' : 'btn-outline-secondary' }}">
                                {{ $semana->completado ? 'Completado' : 'Marcar' }}
                            </button>
                        </form>

                        <form action="{{ route('semana.destroy', $semana->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay semanas para esta materia.</p>
    @endif

    <!-- JavaScript DIRECTO en la vista -->
    <script>
        console.log('Script de edición cargado'); // Para verificar que el script se ejecuta

        function editarSemana(id, nombreActual) {
            console.log('editarSemana llamado con ID:', id, 'Nombre:', nombreActual);
            var form = document.getElementById('editarSemanaForm');
            var input = document.getElementById('inputEditarSemana');
            var formAction = document.getElementById('formEditarSemana');

            if (!form || !input || !formAction) {
                console.error('No se encontraron los elementos del formulario');
                alert('Error: No se encontró el formulario de edición');
                return;
            }

            input.value = nombreActual;
            formAction.action = '/semana/' + id;
            form.style.display = 'block';
            input.focus();
            console.log('Formulario mostrado');
        }

        function cancelarEdicion() {
            var form = document.getElementById('editarSemanaForm');
            if (form) {
                form.style.display = 'none';
                console.log('Formulario ocultado');
            }
        }
    </script>
@endsection