@extends('layouts.app')

@section('title', 'Mi Equipo')

@section('content')
    @if(!$equipo)
        <!-- Si el usuario no tiene equipo, mostrar un mensaje y un botón para crearlo -->
        <div class="no-equipo">
            <h2>No tienes un equipo creado.</h2>
            <a href="{{ route('equipo.create') }}" class="btn btn-primary">Crear Equipo</a>
        </div>
    @else
        <!-- Mostrar el equipo si ya está creado -->
        <table>
            <thead>
            <tr>
                <th>Posición</th>
                <th>Jugador</th>
                <th>Equipo NFL</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posiciones as $pos => $jugador)
                <tr>
                    <td>{{ $pos }}</td>
                    <td>{{ $jugador ? $jugador->nombre . ' ' . $jugador->apellido : '-' }}</td>
                    <td>{{ $jugador && $jugador->equipoNFL ? $jugador->equipoNFL->nombre : '-' }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="3" style="background-color: #f2f2f2;"></td>
            </tr>

            @foreach ($banca as $bnJugador)
                <tr>
                    <td>BN</td>
                    <td>{{ $bnJugador->nombre . ' ' . $bnJugador->apellido }}</td>
                    <td>{{ $bnJugador->equipoNFL ? $bnJugador->equipoNFL->nombre : '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
