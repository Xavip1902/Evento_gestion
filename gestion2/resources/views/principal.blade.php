<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Eventos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f72585;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background-color: var(--dark-color);
            color: white;
            padding: 20px 0;
        }

        .logo {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .logo h2 {
            color: white;
            font-size: 1.5rem;
        }

        .logo span {
            color: var(--primary-color);
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .stat-card.primary .icon {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .stat-card.success .icon {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }

        .stat-card.warning .icon {
            background-color: rgba(248, 150, 30, 0.1);
            color: var(--warning-color);
        }

        .stat-card.danger .icon {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
        }

        .stat-card h3 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        .table-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            color: var(--primary-color);
            font-size: 1.4rem;
        }

        .btn {
            padding: 8px 15px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }

        .btn i {
            margin-right: 5px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: #212529;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            color: var(--gray-color);
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-active {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }

        .badge-finished {
            background-color: rgba(108, 117, 125, 0.1);
            color: var(--gray-color);
        }

        .badge-canceled {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
        }

        .badge-registered {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        .qr-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .message {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 992px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr 1fr;
            }
            
            table, thead, tbody, th, td, tr {
                display: block;
            }
            
            thead tr {
                display: none;
            }
            
            tbody tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 15px;
                background: white;
            }
            
            tbody tr td {
                padding: 8px 10px;
                text-align: right;
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #eee;
            }
            
            tbody tr td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                padding-left: 10px;
                font-weight: 700;
                text-align: left;
                color: var(--gray-color);
            }
            
            tbody tr td:last-child {
                border-bottom: 0;
            }
            
            .actions {
                justify-content: flex-end;
            }
        }

        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-info {
                margin-top: 15px;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>Plant<span>EA</span></h2>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('principal') }}" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('evento.index') }}" class="nav-link">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Eventos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('asistentes.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Asistentes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('eventos.export.pdf') }}" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reportes</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Panel de Gestión de Eventos</h1>
                <div class="user-info">
                    <img src="https://i.pinimg.com/736x/2e/aa/fd/2eaafdcf38154a4fe8bbe41797ee2211.jpg" alt="Usuario">
                    <span>Administrador</span>
                </div>
            </div>

            @if(session('success'))
                <div class="message success" role="alert" aria-live="polite">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="message error" role="alert" aria-live="polite">{{ session('error') }}</div>
            @endif

            <!-- Estadísticas principales -->
            <div class="stats-container">
                <div class="stat-card primary">
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>{{ $eventos->where('estado', 'activo')->count() }}</h3>
                    <p>Eventos Activos</p>
                </div>
                <div class="stat-card success">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>{{ $asistentes->count() }}</h3>
                    <p>Total Asistentes</p>
                </div>
                <div class="stat-card warning">
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>{{ $asistentes->where('estado_asistencia', 'asistió')->count() }}</h3>
                    <p>Asistencias Confirmadas</p>
                </div>
                <div class="stat-card danger">
                    <div class="icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h3>{{ $eventos->where('estado', 'cancelado')->count() }}</h3>
                    <p>Eventos Cancelados</p>
                </div>
            </div>

            <!-- Tabla de Eventos -->
            <div class="table-section">
                <div class="section-header">
                    <h2>Eventos Registrados</h2>
                    <a href="{{ route('evento.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Nuevo Evento</span>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Ubicación</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventos as $evento)
                        <tr>
                            <td data-label="Nombre">{{ $evento->nombre_evento }}</td>
                            <td data-label="Fecha Inicio">{{ $evento->fecha_inicio->format('d/m/Y') }}</td>
                            <td data-label="Fecha Fin">{{ $evento->fecha_fin->format('d/m/Y') }}</td>
                            <td data-label="Ubicación">{{ $evento->ubicacion }}</td>
                            <td data-label="Estado">
                                @if($evento->estado == 'activo')
                                    <span class="badge badge-active">Activo</span>
                                @elseif($evento->estado == 'finalizado')
                                    <span class="badge badge-finished">Finalizado</span>
                                @else
                                    <span class="badge badge-canceled">Cancelado</span>
                                @endif
                            </td>
                            <td data-label="Tipo">{{ $evento->tipo_evento }}</td>
                            <td data-label="Acciones" class="actions">
                                <a href="{{ route('evento.edit', $evento->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('evento.eliminar', $evento->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('evento.edit', $evento->id) }}" class="btn btn-primary btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tabla de Asistentes -->
            <div class="table-section">
                <div class="section-header">
                    <h2>Asistentes Registrados</h2>
                    <a href="{{ route('asistentes.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Nuevo Asistente</span>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Evento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asistentes as $asistente)
                        <tr>
                            <td data-label="Nombre">{{ $asistente->nombre }}</td>
                            <td data-label="Email">{{ $asistente->email }}</td>
                            <td data-label="Teléfono">{{ $asistente->telefono ?? 'N/A' }}</td>
                            <td data-label="Evento">{{ $asistente->evento->nombre_evento ?? 'Evento eliminado' }}</td>
                            <td data-label="Estado">
                                @if($asistente->estado_asistencia == 'asistió')
                                    <span class="badge badge-active">Asistió</span>
                                @elseif($asistente->estado_asistencia == 'registrado')
                                    <span class="badge badge-registered">Registrado</span>
                                @else
                                    <span class="badge badge-canceled">No asistió</span>
                                @endif
                            </td>
                            <td data-label="Acciones" class="actions">
                                <a href="{{ route('asistentes.edit', $asistente->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('asistentes.eliminar', $asistente->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este asistente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>