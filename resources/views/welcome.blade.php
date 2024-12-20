
@extends('layouts.app')

@section('title', 'Página Principal')

@section('content')
    <div class="main-page">
        <header>
            <h1>Ultimate League Football</h1>
            @if (Route::has('login'))
                <nav class="auth-buttons -mx-3 flex flex-1 justify-end">
                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="ml-4">
                            @csrf
                            <button type="submit"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Log out
                            </button>
                        </form>

                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="main-section">
            <h2>ULF Fantasy Ha Comenzado!</h2>
            <p>Únete a una liga o crea la tuya propia!</p>
            <div class="button-group">
                <a href="{{ route('register') }}">Comenzar una liga</a>
                <a href="{{ route('register') }}">Unirse a una liga</a>
            </div>
        </div>
    </div>
@endsection
