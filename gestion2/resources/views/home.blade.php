<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>¡Bienvenido, {{ auth()->user()->name }}!</h1>
    <p>Has iniciado sesión correctamente.</p>
    <a href="{{ route('logout') }}">Cerrar sesión</a>
</body>
</html>
