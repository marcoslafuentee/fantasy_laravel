<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Proyecto')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<header>
    <!-- Aquí va el contenido del header -->
</header>

<main>
    @yield('content')
</main>

<footer>
    <!-- Aquí va el contenido del footer -->
</footer>

<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
