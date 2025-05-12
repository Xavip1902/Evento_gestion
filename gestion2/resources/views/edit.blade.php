{{-- filepath: resources/views/evento/edit.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .form-title {
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-submit {
            background-color: #3498db;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }
        .btn-submit:hover {
            background-color: #2980b9;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="form-container">
            <h1 class="form-title">Editar Evento</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('evento.update', $evento->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre_evento" class="form-label">Nombre del Evento</label>
                    <input type="text" class="form-control" name="nombre_evento" id="nombre_evento" 
                           value="{{ old('nombre_evento', $evento->nombre_evento) }}" required>
                    @error('nombre_evento')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="4" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" 
                               value="{{ old('fecha_inicio', $evento->fecha_inicio ? \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d') : '') }}" required>
                        @error('fecha_inicio')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" 
                              value="{{ old('fecha_fin', $evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d') : '') }}" required>
                        @error('fecha_fin')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" name="ubicacion" id="ubicacion" 
                           value="{{ old('ubicacion', $evento->ubicacion) }}" required>
                    @error('ubicacion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" name="estado" id="estado" required>
                        <option value="activo" {{ old('estado', $evento->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="finalizado" {{ old('estado', $evento->estado) == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="cancelado" {{ old('estado', $evento->estado) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('estado')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tipo_evento" class="form-label">Tipo de Evento</label>
                    <input type="text" class="form-control" name="tipo_evento" id="tipo_evento" 
                           value="{{ old('tipo_evento', $evento->tipo_evento) }}" required>
                    @error('tipo_evento')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('evento.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-submit">Actualizar Evento</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación de fechas
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');
            
            fechaInicio.addEventListener('change', function() {
                fechaFin.min = this.value;
            });
            
            fechaFin.addEventListener('change', function() {
                if(new Date(this.value) < new Date(fechaInicio.value)) {
                    alert('La fecha de fin no puede ser anterior a la fecha de inicio');
                    this.value = '';
                }
            });
        });
    </script>
</body>
</html>