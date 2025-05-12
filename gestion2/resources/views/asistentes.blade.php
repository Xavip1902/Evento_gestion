<!DOCTYPE html>
<html>
<head>
    <title>Registrar Asistente</title>
</head>
<body>
    <h1>Registrar nuevo asistente</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/asistentes" method="post">
        @csrf

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono"><br><br>

        <label>Evento:</label>
        <select name="evento_id" required>
    <option value="">Selecciona un evento</option>
    @foreach($eventos as $evento)
        <option value="{{ $evento->id }}">{{ $evento->nombre_evento }}</option>
    @endforeach
</select><br><br>

        <label>Estado de asistencia:</label>
        <select name="estado_asistencia" required>
            <option value="registrado">registrado</option>
            <option value="asistió">asistió</option>
            <option value="no asistió">no asistió</option>
        </select><br><br>

        <button type="submit">Guardar</button>

    
    </form>
</body>
</html>
