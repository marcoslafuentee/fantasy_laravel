@extends('layouts.app')

@section('title', 'Unirse a una Liga')

@section('content')
    <div class="main-page">
        <div class="main-section">
            <h1>Unirse a una Liga</h1>

            <ul>
                @foreach($ligas as $liga)
                    <li>
                        <h2>{{ $liga->nombre }}</h2>
                        <p>Número máximo de usuarios: {{ $liga->max_users }}</p>
                        <p>Usuarios actuales: {{ $liga->users->count() }}</p>
                        @if($liga->isFull())
                            <p>Esta liga está llena.</p>
                        @else
                            <form action="{{ route('ligas.joinLeague', $liga->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">Unirse</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
