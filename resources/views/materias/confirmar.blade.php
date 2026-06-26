@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Confirmar inscripción</div>
                <div class="card-body">
                    <h4>¿Deseas unirte a la siguiente materia?</h4>

                    <div class="mt-4 p-3" style="background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);">
                        <p><strong>Nombre:</strong> {{ $materia->nombre }}</p>
                        <p><strong>Descripción:</strong> {{ $materia->descripcion }}</p>
                        <p><strong>Docente:</strong> {{ $materia->user->name }}</p>
                        <p><strong>Código:</strong> {{ $materia->codigo_invitacion }}</p>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <form action="{{ route('materias.confirmar.store', $materia->codigo_invitacion) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Aceptar</button>
                        </form>
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection