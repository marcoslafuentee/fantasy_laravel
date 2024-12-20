@extends('layouts.app')

@section('title', 'Crear Equipo')

@section('content')
    <h2>Crear un Nuevo Equipo</h2>

    <form action="{{ route('equipo.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Equipo:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <!-- Campo oculto para enviar el id de la liga -->
        <input type="hidden" name="liga_id" value="{{ $ligaId }}">

        <button type="submit" class="btn btn-success">Crear Equipo</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
