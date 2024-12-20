@extends('layouts.app')

@section('title', 'Crear Liga')

@section('content')
    <div class="main-page">
        <div class="main-section">
            <h1>Crear Liga</h1>

            <form action="{{ route('ligas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre de la Liga</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="max_users">Número Máximo de Usuarios</label>
                    <input type="number" id="max_users" name="max_users" class="form-control" required min="1">
                </div>

                <button type="submit" class="btn">Crear Liga</button>
            </form>
        </div>
    </div>
@endsection
