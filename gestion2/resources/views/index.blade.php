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
            flex-direction: column;
            align-items: center;
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
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
            position: relative;
        }
        
        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--success-color));
            margin: 15px auto 0;
            border-radius: 2px;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95rem;
            animation: slideIn 0.4s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
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

        .form-group {
            position: relative;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: var(--dark-color);
            transition: var(--transition);
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
            position: relative;
            overflow: hidden;
        }

        button:hover,
        button:focus {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(63, 55, 201, 0.6);
            outline: none;
        }
        
        button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        button:focus:not(:active)::after {
            animation: ripple 0.6s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        .regresar-btn {
            margin-top: 20px;
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 700;
            letter-spacing: 0.03em;
            box-shadow: 0 3px 6px rgba(67, 97, 238, 0.4);
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .regresar-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(63, 55, 201, 0.6);
        }
        
        /* Validación en tiempo real */
        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
            animation: shake 0.4s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        .invalid {
            border-color: var(--error-color) !important;
        }
        
        .valid {
            border-color: var(--success-color) !important;
        }
        
        /* Efecto de carga */
        .loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Tooltips */
        .tooltip {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            cursor: help;
        }
        
        .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: var(--dark-color);
            color: #fff;
            text-align: center;
            border-radius: var(--border-radius);
            padding: 10px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.9rem;
            font-weight: normal;
        }
        
        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
                margin: 20px 10px;
                animation: none;
            }
            button {
                font-size: 1rem;
                padding: 12px;
            }
            .regresar-btn {
                font-size: 0.95rem;
                padding: 10px 20px;
            }
            h1 {
                font-size: 1.5rem;
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

        <form action="/evento" method="post" novalidate id="eventoForm">
            @csrf  

            <div class="form-group">
                <label for="nombre_evento">Nombre del evento:</label>
                <input type="text" id="nombre_evento" name="nombre_evento" required autocomplete="off" 
                       pattern=".{5,100}" title="El nombre debe tener entre 5 y 100 caracteres" />
                <div class="error-message" id="nombre-error">El nombre debe tener entre 5 y 100 caracteres</div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required minlength="20" maxlength="500"></textarea>
                <div class="error-message" id="descripcion-error">La descripción debe tener entre 20 y 500 caracteres</div>
                <div class="char-counter"><span id="descripcion-counter">0</span>/500</div>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required />
                <div class="error-message" id="fecha-inicio-error">La fecha de inicio no puede ser anterior a hoy</div>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required />
                <div class="error-message" id="fecha-fin-error">La fecha de fin no puede ser anterior a la de inicio</div>
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required autocomplete="off" 
                       pattern=".{5,150}" title="La ubicación debe tener entre 5 y 150 caracteres" />
                <div class="error-message" id="ubicacion-error">La ubicación debe tener entre 5 y 150 caracteres</div>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="" disabled selected>Seleccione estado</option>
                    <option value="activo">Activo</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                <div class="error-message" id="estado-error">Por favor seleccione un estado</div>
            </div>

            <div class="form-group">
                <label for="tipo_evento">Tipo de evento:</label>
                <input type="text" id="tipo_evento" name="tipo_evento" required autocomplete="off" 
                       pattern=".{3,50}" title="El tipo de evento debe tener entre 3 y 50 caracteres" />
                <div class="error-message" id="tipo-error">El tipo de evento debe tener entre 3 y 50 caracteres</div>
                <div class="tooltip">?
                    <span class="tooltip-text">Ejemplos: Conferencia, Taller, Seminario, Fiesta, Reunión</span>
                </div>
            </div>

            <button type="submit" aria-label="Guardar nuevo evento" id="submitBtn">Guardar Evento</button>
        </form>
    </main>

    <a href="principal" class="regresar-btn" aria-label="Volver a la página anterior">⟵ Regresar</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('eventoForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Elementos del formulario
            const nombreEvento = document.getElementById('nombre_evento');
            const descripcion = document.getElementById('descripcion');
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');
            const ubicacion = document.getElementById('ubicacion');
            const estado = document.getElementById('estado');
            const tipoEvento = document.getElementById('tipo_evento');
            
            // Mensajes de error
            const nombreError = document.getElementById('nombre-error');
            const descripcionError = document.getElementById('descripcion-error');
            const fechaInicioError = document.getElementById('fecha-inicio-error');
            const fechaFinError = document.getElementById('fecha-fin-error');
            const ubicacionError = document.getElementById('ubicacion-error');
            const estadoError = document.getElementById('estado-error');
            const tipoError = document.getElementById('tipo-error');
            
            // Contador de caracteres
            const descripcionCounter = document.getElementById('descripcion-counter');
            
            // Establecer fecha mínima (hoy)
            const today = new Date().toISOString().split('T')[0];
            fechaInicio.min = today;
            fechaFin.min = today;
            
            // Validación en tiempo real
            nombreEvento.addEventListener('input', validateNombre);
            descripcion.addEventListener('input', validateDescripcion);
            fechaInicio.addEventListener('change', validateFechas);
            fechaFin.addEventListener('change', validateFechas);
            ubicacion.addEventListener('input', validateUbicacion);
            estado.addEventListener('change', validateEstado);
            tipoEvento.addEventListener('input', validateTipo);
            
            // Contador de caracteres para descripción
            descripcion.addEventListener('input', function() {
                const length = this.value.length;
                descripcionCounter.textContent = length;
                
                if (length > 500) {
                    this.classList.add('invalid');
                    descripcionError.style.display = 'block';
                } else {
                    this.classList.remove('invalid');
                    descripcionError.style.display = 'none';
                }
            });
            
            // Validación al enviar el formulario
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (validateForm()) {
                    // Simular envío (en un caso real sería una petición AJAX)
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                    
                    // Simular retraso de red
                    setTimeout(() => {
                        form.submit();
                    }, 1500);
                }
            });
            
            // Funciones de validación
            function validateNombre() {
                const value = nombreEvento.value.trim();
                if (value.length < 5 || value.length > 100) {
                    nombreEvento.classList.add('invalid');
                    nombreError.style.display = 'block';
                    return false;
                } else {
                    nombreEvento.classList.remove('invalid');
                    nombreEvento.classList.add('valid');
                    nombreError.style.display = 'none';
                    return true;
                }
            }
            
            function validateDescripcion() {
                const value = descripcion.value.trim();
                if (value.length < 20 || value.length > 500) {
                    descripcion.classList.add('invalid');
                    descripcionError.style.display = 'block';
                    return false;
                } else {
                    descripcion.classList.remove('invalid');
                    descripcion.classList.add('valid');
                    descripcionError.style.display = 'none';
                    return true;
                }
            }
            
            function validateFechas() {
                let isValid = true;
                
                // Validar fecha de inicio
                if (!fechaInicio.value) {
                    fechaInicio.classList.add('invalid');
                    fechaInicioError.textContent = 'Por favor ingrese una fecha de inicio';
                    fechaInicioError.style.display = 'block';
                    isValid = false;
                } else {
                    fechaInicio.classList.remove('invalid');
                    fechaInicio.classList.add('valid');
                    fechaInicioError.style.display = 'none';
                }
                
                // Validar fecha de fin
                if (!fechaFin.value) {
                    fechaFin.classList.add('invalid');
                    fechaFinError.textContent = 'Por favor ingrese una fecha de fin';
                    fechaFinError.style.display = 'block';
                    isValid = false;
                } else if (fechaInicio.value && fechaFin.value < fechaInicio.value) {
                    fechaFin.classList.add('invalid');
                    fechaFinError.textContent = 'La fecha de fin no puede ser anterior a la de inicio';
                    fechaFinError.style.display = 'block';
                    isValid = false;
                } else {
                    fechaFin.classList.remove('invalid');
                    fechaFin.classList.add('valid');
                    fechaFinError.style.display = 'none';
                }
                
                return isValid;
            }
            
            function validateUbicacion() {
                const value = ubicacion.value.trim();
                if (value.length < 5 || value.length > 150) {
                    ubicacion.classList.add('invalid');
                    ubicacionError.style.display = 'block';
                    return false;
                } else {
                    ubicacion.classList.remove('invalid');
                    ubicacion.classList.add('valid');
                    ubicacionError.style.display = 'none';
                    return true;
                }
            }
            
            function validateEstado() {
                if (!estado.value) {
                    estado.classList.add('invalid');
                    estadoError.style.display = 'block';
                    return false;
                } else {
                    estado.classList.remove('invalid');
                    estado.classList.add('valid');
                    estadoError.style.display = 'none';
                    return true;
                }
            }
            
            function validateTipo() {
                const value = tipoEvento.value.trim();
                if (value.length < 3 || value.length > 50) {
                    tipoEvento.classList.add('invalid');
                    tipoError.style.display = 'block';
                    return false;
                } else {
                    tipoEvento.classList.remove('invalid');
                    tipoEvento.classList.add('valid');
                    tipoError.style.display = 'none';
                    return true;
                }
            }
            
            function validateForm() {
                const isNombreValid = validateNombre();
                const isDescripcionValid = validateDescripcion();
                const isFechasValid = validateFechas();
                const isUbicacionValid = validateUbicacion();
                const isEstadoValid = validateEstado();
                const isTipoValid = validateTipo();
                
                return isNombreValid && isDescripcionValid && isFechasValid && 
                       isUbicacionValid && isEstadoValid && isTipoValid;
            }
            
            // Efecto de hover en los campos
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('label').style.color = var(--primary-color);
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('label').style.color = var(--dark-color);
                });
            });
        });
    </script>
</body>
</html>