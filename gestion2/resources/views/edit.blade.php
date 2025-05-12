<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asistente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 150px; font-weight: bold; }
        input, select { padding: 8px; width: 300px; }
        button { padding: 8px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-success { background-color: #dff0d8; color: #3c763d; }
        .alert-danger { background-color: #f2dede; color: #a94442; }
    </style>
</head>
<body>
    <h1>Editar Asistente</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    <form action="{{ route('asistentes.update', $asistente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $asistente->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $asistente->email) }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $asistente->telefono) }}">
        </div>

        <div class="form-group">
            <label for="evento_id">Evento:</label>
            <select name="evento_id" id="evento_id" required>
                <option value="">Seleccione un evento</option>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}" {{ old('evento_id', $asistente->evento_id) == $evento->id ? 'selected' : '' }}>
                        {{ $evento->nombre_evento }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estado_asistencia">Estado de Asistencia:</label>
            <select name="estado_asistencia" id="estado_asistencia" required>
                <option value="registrado" {{ old('estado_asistencia', $asistente->estado_asistencia) == 'registrado' ? 'selected' : '' }}>Registrado</option>
                <option value="asistió" {{ old('estado_asistencia', $asistente->estado_asistencia) == 'asistió' ? 'selected' : '' }}>Asistió</option>
                <option value="no asistió" {{ old('estado_asistencia', $asistente->estado_asistencia) == 'no asistió' ? 'selected' : '' }}>No asistió</option>
            </select>
        </div>

        <button type="submit">Actualizar</button>
        <a href="{{ route('asistentes.index') }}" style="margin-left: 10px;">Cancelar</a>
    </form>
</body>
</html>