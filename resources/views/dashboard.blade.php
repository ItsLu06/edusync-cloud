@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Bienvenido, {{ Auth::user()->name }}</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Materias en curso</h5>
                <h2>{{ $materiasEnCurso ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Progreso general</h5>
                <h2>{{ $progresoGeneral ?? 0 }}%</h2>
                <div class="progress">
                    <div class="progress-bar" style="width: {{ $progresoGeneral ?? 0 }}%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Certificados</h5>
                <h2>{{ $certificados ?? 0 }}</h2>
            </div>
        </div>
    </div>
@endsection