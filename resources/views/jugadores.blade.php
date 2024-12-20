@extends('layouts.app')

@section('title', 'Clasificación de Usuarios')

@section('content')
    <div class="main-page">
        <header>
            <h1>Ultimate League Football</h1>
        </header>
        <div class="main-section">
            <h1>Lista de Jugadores</h1>

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
                            <th>Posición</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Equipo NFL</th>
                            <th>Puntos Fantasy</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jugadores as $jugador)
                            <tr>
                                <td>{{ $jugador->posicion }}</td>
                                <td>{{ $jugador->nombre }}</td>
                                <td>{{ $jugador->apellido }}</td>
                                <td>{{ $jugador->equipoNFL->nombre_completo }}</td>
                                <td>{{ $jugador->puntos_fantasy }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Enlaces de paginación -->
                <div class="pagination">
                    {{ $jugadores->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
