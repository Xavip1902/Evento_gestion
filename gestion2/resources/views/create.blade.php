<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Asistente</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #2980b9;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Nuevo Asistente</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('asistentes.guardar') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" name="nombre" id="nombre" 
                       value="{{ old('nombre') }}" required>
                @error('nombre')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono (Opcional):</label>
                <input type="text" name="telefono" id="telefono" 
                       value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="evento_id">Evento:</label>
                <select name="evento_id" id="evento_id" required>
                    <option value="">Seleccione un evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}" {{ old('evento_id') == $evento->id ? 'selected' : '' }}>
                            {{ $evento->nombre_evento }} ({{ $evento->fecha_inicio->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
                @error('evento_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="estado_asistencia">Estado de Asistencia:</label>
                <select name="estado_asistencia" id="estado_asistencia" required>
                    <option value="registrado" {{ old('estado_asistencia') == 'registrado' ? 'selected' : '' }}>Registrado</option>
                    <option value="asistió" {{ old('estado_asistencia') == 'asistió' ? 'selected' : '' }}>Asistió</option>
                    <option value="no asistió" {{ old('estado_asistencia') == 'no asistió' ? 'selected' : '' }}>No asistió</option>
                </select>
                @error('estado_asistencia')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Registrar Asistente</button>
            <a href="{{ route('asistentes.index') }}" class="btn" style="background: #6c757d; margin-left: 10px;">Cancelar</a>
        </form>
    </div>
</body>
</html>