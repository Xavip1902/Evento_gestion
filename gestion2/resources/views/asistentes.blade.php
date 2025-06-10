<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrar Asistente</title>
    <style>
        :root {
            --color-primary: #4a6ef5;
            --color-primary-dark: #364fc7;
            --color-success: #38b000;
            --color-error: #e63946;
            --color-light-bg: #f8f9fa;
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            font-family: var(--font-family);
            background: var(--color-light-bg);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: var(--color-primary);
            margin-bottom: 25px;
            font-size: 24px;
        }

        .message-success,
        .message-error {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .message-success {
            background-color: #d1f7e4;
            color: var(--color-success);
        }

        .message-error {
            background-color: #ffd6d6;
            color: var(--color-error);
        }

        ul.errors-list {
            color: var(--color-error);
            padding-left: 20px;
            margin-bottom: 15px;
        }

        form label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        form input[type="text"],
        form input[type="email"],
        form select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        form input:focus,
        form select:focus {
            border-color: var(--color-primary);
            outline: none;
        }

        button {
            width: 100%;
            background-color: var(--color-primary);
            color: white;
            font-weight: 600;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--color-primary-dark);
        }

        #loadingSpinner {
            display: none;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: var(--color-primary);
            font-weight: 600;
        }

        .regresar-btn {
            display: inline-block;
            background-color: var(--color-primary);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
            text-align: center;
            margin-top: 20px;
        }

        .regresar-btn:hover {
            background-color: var(--color-primary-dark);
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar nuevo asistente</h1>

        @if(session('success'))
            <div class="message-success" role="alert">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="message-error" role="alert">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <ul class="errors-list" role="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="/asistentes" method="post" novalidate>
            @csrf

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ej: Jorge Salado">

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="Ej: jorge@email.com">

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Ej: +503 7000-0000">

            <label for="evento_id">Evento:</label>
            <select id="evento_id" name="evento_id" required>
                <option value="" disabled selected>Selecciona un evento</option>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}">{{ $evento->nombre_evento }}</option>
                @endforeach
            </select>

            <label for="estado_asistencia">Estado de asistencia:</label>
            <select id="estado_asistencia" name="estado_asistencia" required>
                <option value="registrado">Registrado</option>
                <option value="asistió">Asistió</option>
                <option value="no asistió">No asistió</option>
            </select>

            <button type="submit" id="submitBtn">Guardar</button>
            <div id="loadingSpinner" role="status">⏳ Guardando...</div>
        </form>
    </div>

    <a href="principal" class="regresar-btn">⟵ Regresar</a>

    <script>
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('loadingSpinner');

        form.addEventListener('submit', () => {
            submitBtn.style.display = 'none';
            spinner.style.display = 'block';
        });
    </script>
</body>
</html>
