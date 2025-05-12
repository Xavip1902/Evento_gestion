<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asistente</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Editar Asistente</h1>
    
 
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

    <form action="{{ route('asistentes.actualizar', $asistente->id) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" 
                   value="{{ old('nombre', $asistente->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" 
                   value="{{ old('email', $asistente->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono" 
                   value="{{ old('telefono', $asistente->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="evento_id" class="form-label">Evento:</label>
            <select name="evento_id" id="evento_id" class="form-select" required>
                @foreach ($eventos as $evento)
                    <option value="{{ $evento->id }}" {{ old('evento_id', $asistente->evento_id) == $evento->id ? 'selected' : '' }}>
                        {{ $evento->nombre_evento }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="estado_asistencia" class="form-label">Estado de Asistencia:</label>
            <select name="estado_asistencia" id="estado_asistencia" class="form-select" required>
                <option value="registrado" {{ old('estado_asistencia', $asistente->estado_asistencia) == 'registrado' ? 'selected' : '' }}>Registrado</option>
                <option value="asistió" {{ old('estado_asistencia', $asistente->estado_asistencia) == 'asistió' ? 'selected' : '' }}>Asistió</option>
                <option value="no asistió" {{ old('estado_asistencia', $asistente->estado_asistencia) == 'no asistió' ? 'selected' : '' }}>No asistió</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('principal') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>