<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Bootstrap 5 y Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
          
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

			background: url('https://cdn.discordapp.com/attachments/1379967309598429297/1381780259917140019/image0.jpg?ex=6848c2a6&is=68477126&hm=cad2738f36496ff47ee9e444a88f70abc26f4b9aa9fb8e1acf3a545ded0092f2&') no-repeat center center fixed;
			background-size: cover;
        }

        .card-login {
            background: #ffffffcc;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-top: -70px;
        }

        .form-control {
            border-radius: 30px;
            padding: 12px 20px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(164, 105, 189, 0.25);
            border-color: #a569bd;
        }

        .btn-login {
            background: #a569bd;
            border: none;
            border-radius: 30px;
            padding: 10px;
            color: white;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #8e44ad;
            box-shadow: 0 4px 15px rgba(142, 68, 173, 0.4);
            transform: translateY(-2px);
        }

        .alert-danger {
            background-color: #fcebea;
            color: #e74c3c;
            border: 2px solid #e74c3c;
            font-weight: bold;
            border-radius: 15px;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    <div class="card-login text-center position-relative">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC5jom4gOehCdYga_ifJSBeeshWUCVdWh7iw&s" alt="Logo" class="logo-img position-absolute top-0 start-50 translate-middle">

        <h4 class="mt-5 mb-3">Bienvenido</h4>
        <p class="text-muted mb-4">Por favor, ingresa tus credenciales</p>

        <form action="/login" method="POST">
            @csrf

            @if ($errors->has('name'))
                <div class="alert alert-danger mb-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ $errors->first('name') }}
                </div>
            @endif

            <div class="input-group mb-3">
                <span class="input-group-text bg-light"><i class="fas fa-user text-purple"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Usuario" required value="{{ old('name') }}">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-light"><i class="fas fa-key text-purple"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn btn-login w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
            </button>
        </form>

        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para ocultar alertas -->
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => alert.classList.add('fade'));
        }, 4000);
    </script>

</body>
</html>
