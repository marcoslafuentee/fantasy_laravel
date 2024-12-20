
@extends('layouts.app')

@section('title', 'Mis Ligas')

@section('content')
    <div class="main-page">
        <div class="main-section">
            <h1>Mis Ligas</h1>

            <!-- Mostrar ligas del usuario -->
            @if($ligas->isEmpty())
                <p>No estás registrado en ninguna liga.</p>
            @else
                <div class="box-container">
                    <div class="table-container">
                        <table>
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Número máximo de usuarios</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ligas as $liga)
                                <tr>
                                    <td>{{ $liga->nombre }}</td>
                                    <td>{{ $liga->max_users }}</td>
                                    <td>
                                        <!-- Aquí puedes añadir más acciones, como ver los detalles de la liga -->
                                        <a href="{{ route('ligas.clasificacion', $liga->id) }}" class="btn">Entrar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Botones para crear o unirse a una liga -->
            <div class="button-group">
                <a href="{{ route('ligas.create') }}" class="btn">Crear Liga</a>
                <a href="{{ route('ligas.join') }}" class="btn">Unirse a una Liga</a>
            </div>
        </div>
    </div>
@endsection
