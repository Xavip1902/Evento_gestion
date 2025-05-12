<!DOCTYPE html>
<html>
<head>
    <title>Lista de Asistentes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
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
    </style>
</head>
<body>
 <h1>Asistentes Registrados</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <a href="{{ route('asistentes.create') }}" class="btn btn-success">
        Nuevo Asistente
    </a>

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
                        <a href="{{ route('asistentes.edit', $asistente->id) }}" class="btn btn-warning">
                            Editar
                        </a>
                        
                        <form action="{{ route('asistentes.destroy', $asistente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('¿Eliminar este asistente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="{{ route('eventos.index') }}" style="margin-right: 10px;">Ver Eventos</a>
        <a href="{{ route('asistentes.principal') }}">Vista Principal</a>
    </div>
</body>
</html>