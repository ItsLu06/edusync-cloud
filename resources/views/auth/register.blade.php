<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync - Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --accent-color: #f5a623;
            --glow-color: rgba(245,166,35,0.3);
        }
        body {
            background: #0d0d0d;
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 2rem;
            max-width: 460px;
            width: 100%;
        }
        .glow-text {
            color: var(--accent-color);
            text-shadow: 0 0 30px var(--glow-color);
        }
        .form-control {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: #e0e0e0;
            border-radius: 10px;
            padding: 12px;
        }
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 20px var(--glow-color);
            background: rgba(255,255,255,0.08);
            color: #e0e0e0;
        }
        .form-select {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: #e0e0e0;
            border-radius: 10px;
            padding: 12px;
        }
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 20px var(--glow-color);
            background: rgba(255,255,255,0.08);
            color: #e0e0e0;
        }
        .btn-primary {
            background: var(--accent-color);
            color: #0d0d0d;
            border: none;
            padding: 12px;
            border-radius: 30px;
            font-weight: 600;
            box-shadow: 0 0 30px var(--glow-color);
        }
        .btn-primary:hover {
            transform: scale(1.02);
            box-shadow: 0 0 40px var(--glow-color);
        }
        a { color: var(--accent-color); text-decoration: none; }
        a:hover { text-decoration: underline; }
        label { color: #e0e0e0; }
        .text-muted { color: #b0b0b0 !important; }
    </style>
</head>
<body>
    <div class="card">
        <div class="text-center mb-4">
            <h2 class="glow-text" style="font-size: 2rem; font-weight: 700;">EduSync</h2>
            <p class="text-muted">Crea tu cuenta gratis</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name">Nombre completo</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rol">Tipo de usuario</label>
                <select id="rol" name="rol" class="form-select" required>
                    <option value="estudiante">Estudiante</option>
                    <option value="docente">Docente</option>
                </select>
                @error('rol')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm">Confirmar contraseña</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>

            <div class="text-center mt-3">
                <p class="text-muted">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
            </div>
        </form>
    </div>
</body>
</html>