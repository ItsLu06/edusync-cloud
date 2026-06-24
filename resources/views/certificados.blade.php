@extends('layouts.app')

@section('content')
    <h1>Certificados</h1>

    @if($certificados->count() > 0)
        @foreach($certificados as $cert)
            <div class="card p-3 mb-3">
                <h3>{{ $cert->materia->nombre }}</h3>
                <p>Emitido el: {{ $cert->fecha_emision }}</p>
            </div>
        @endforeach
    @else
        <p>No tienes certificados aún. Completa todas las semanas de una materia para obtener uno.</p>
    @endif
@endsection