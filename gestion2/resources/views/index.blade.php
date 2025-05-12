<!DOCTYPE html>
<html>
<head>
    <title>Lista de Eventos</title>
</head>
<body>
    <h1>Crear nuevo evento</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif

    <form action="/evento" method="post">
        @csrf  

        <label>Nombre del evento:</label>
        <input type="text" name="nombre_evento" required><br><br>

        <label>Descripcion:</label>
        <textarea name="descripcion" required></textarea><br><br>

        <label>Fecha de inicio</label>
        <input type="date" name="fecha_inicio" required><br><br>

        <label>Fecha de fin</label>
        <input type="date" name="fecha_fin" required><br><br>

        <label>Ubicacion</label>
        <input type="text" name="ubicacion" required><br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="activo">activo</option>
            <option value="finalizado">finalizado</option>
            <option value="cancelado">cancelado</option>
        </select><br><br>

        <label>Tipo de evento:</label>
        <input type="text" name="tipo_evento" required><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>