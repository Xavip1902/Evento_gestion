<!DOCTYPE html>
<html>
<head>
    <title>Panel de Eventos y Asistentes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { margin-top: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .success { color: green; }
        .error { color: red; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-warning { background-color: #ffc107; }
        .btn-danger { background-color: #dc3545; }
        .btn-success { background-color: #28a745; }
        .btn-sm { font-size: 12px; padding: 4px 8px; }
    </style>
</head>
<body>

    <h1>Eventos Registrados</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <a href="{{ route('evento.index') }}" class="btn btn-success">Nuevo Registro-Evento</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Ubicación</th>
                <th>Organizador</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->id }}</td>
                    <td>{{ $evento->nombre_evento }}</td>
                    <td>{{ $evento->descripcion }}</td>
                    <td>{{ $evento->fecha_inicio }}</td>
                    <td>{{ $evento->fecha_fin }}</td>
                    <td>{{ $evento->ubicacion }}</td>
                    <td>{{ $evento->organizador->name ?? 'N/A' }}</td>
                    <td>{{ $evento->estado }}</td>
                    <td>{{ $evento->tipo_evento }}</td>
                    <td>
                        <a href="{{ route('evento.edit', $evento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <form action="{{ route('evento.eliminar', $evento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este evento?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

  
    <h1>Asistentes Registrados</h1>

    <a href="/asistentes" class="btn btn-success">Nuevo Asistente</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Evento</th>
                <th>Estado</th>
                <th>Código QR</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistentes as $asistente)
                <tr>
                    <td>{{ $asistente->id }}</td>
                    <td>{{ $asistente->nombre }}</td>
                    <td>{{ $asistente->email }}</td>
                    <td>{{ $asistente->telefono ?? 'N/A' }}</td>
                    <td>{{ $asistente->evento->nombre_evento ?? 'Evento eliminado' }}</td>
                    <td>{{ ucfirst($asistente->estado_asistencia) }}</td>
                    <td>
                        @if($asistente->codigo_qr)
                            <a href="#" onclick="window.open('/qr/{{ $asistente->codigo_qr }}', 'qr', 'width=300,height=300')">Ver QR</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('asistentes.edit', $asistente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <form action="{{ route('asistentes.eliminar', $asistente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este asistente?')">Eliminar</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>


    </table>

</body>
</html>
