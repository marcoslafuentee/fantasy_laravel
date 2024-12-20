@extends('layouts.app')

@section('title', 'Clasificación de Usuarios')

@section('content')
    <div class="main-page">
        <header>
            <h1>Ultimate League Football</h1>
        </header>
        <div class="main-section">
            <h1>Lista de Usuarios</h1>

            <div class="box-container">
                <!-- Menú de navegación -->
                <div class="menu">
                    <a href="{{ route('users.index') }}" class="active">Clasificación</a>
                    <a href="#">Calendario</a>
                    <a href="{{ route('equipo') }}">Equipo</a>
                    <a href="{{ route('jugadores') }}">Jugadores</a>
                </div>

                <!-- Contenedor de la tabla -->
                <div class="table-container">
                    <table>
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <!-- Añade más columnas si es necesario -->
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <!-- Añade más celdas si es necesario -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No hay usuarios disponibles.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
