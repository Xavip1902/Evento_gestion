<!DOCTYPE html>
<html>
<head>
    <title>Lista de Eventos</title>
</head>
<body>
    <h1>CActualizar evento</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif

    <form action="{{route('evento.update')}}" method="post">
        @csrf  
        @methodo('put')

        <label>Nombre del evento:<br> 
        <input type="text" name="nombre_evento"     value ="{{$evento->nombre_evento}}"           required> 
</label><br> 


        <label>Descripcion:</label>
        <textarea name="descripcion"               value ="{{$evento->descripcion}}"required></textarea><br><br>

        <label>Fecha de inicio</label>
        <input type="date" name="fecha_inicio" value ="{{$evento->fecha_inicio}}"   required><br><br>

        <label>Fecha de fin</label>
        <input type="date" name="fecha_fin" value ="{{$evento->fecha_fin}}"  required><br><br>

        <label>Ubicacion</label>
        <input type="text" name="ubicacion"  value ="{{$evento->ubicacion}}"  required><br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="activo">activo</option>
            <option value="finalizado">finalizado</option>
            <option value="cancelado">cancelado</option>
        </select><br><br>

        <label>Tipo de evento:</label>
        <input type="text" name="tipo_evento" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>