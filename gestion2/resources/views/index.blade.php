<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Nuevo Evento</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --error-color: #f72585;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
            --max-width: 600px;
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-family);
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            max-width: var(--max-width);
            width: 100%;
            margin: 40px 20px;
            padding: 30px 40px;
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: box-shadow 0.3s ease;
        }
        .container:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.18);
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .alert-success {
            background-color: rgba(76, 201, 240, 0.2);
            color: #0a6c7e;
            border-left: 6px solid var(--success-color);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: var(--dark-color);
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            font-family: var(--font-family);
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 6px rgba(67, 97, 238, 0.4);
            background-color: #fefefe;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
            font-size: 1rem;
            line-height: 1.4;
        }

        button {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 14px;
            font-size: 1.1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 700;
            letter-spacing: 0.03em;
            box-shadow: 0 3px 6px rgba(67, 97, 238, 0.4);
        }

        button:hover,
        button:focus {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(63, 55, 201, 0.6);
            outline: none;
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
                margin: 20px 10px;
            }
            button {
                font-size: 1rem;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <main class="container" role="main" aria-labelledby="titulo-pagina">
        <h1 id="titulo-pagina">Crear Nuevo Evento</h1>

        @if(session('success'))
            <div class="alert alert-success" role="alert" aria-live="polite">
                {{ session('success') }}
            </div>
        @endif

        <form action="/evento" method="post" novalidate>
            @csrf  

            <div class="form-group">
                <label for="nombre_evento">Nombre del evento:</label>
                <input type="text" id="nombre_evento" name="nombre_evento" required autocomplete="off" />
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required />
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required />
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required autocomplete="off" />
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="" disabled selected>Seleccione estado</option>
                    <option value="activo">Activo</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_evento">Tipo de evento:</label>
                <input type="text" id="tipo_evento" name="tipo_evento" required autocomplete="off" />
            </div>

            <button type="submit" aria-label="Guardar nuevo evento">Guardar Evento</button>
        </form>
    </main>
</body>
</html>
