<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Eventos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Eventos</h1>
        <p>Generado el: {{ $fecha }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Asistentes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombre_evento }}</td>
                <td>{{ $evento->fecha_inicio->format('d/m/Y') }}</td>
                <td>{{ $evento->fecha_fin->format('d/m/Y') }}</td>
                <td>{{ $evento->ubicacion }}</td>
                <td>{{ ucfirst($evento->estado) }}</td>
                <td>{{ $evento->asistentes_count ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>