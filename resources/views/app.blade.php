<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0d0d0d;
            --text-color: #e0e0e0;
            --card-bg: rgba(255,255,255,0.05);
            --border-color: rgba(255,255,255,0.1);
            --accent-color: #f5a623;
            --glow-color: rgba(245,166,35,0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
        }

        .sidebar {
            height: 100vh;
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--border-color);
            padding: 1.5rem 1rem;
            position: sticky;
            top: 0;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-color);
            text-shadow: 0 0 20px var(--glow-color);
            margin-bottom: 2rem;
            display: block;
            text-decoration: none;
        }

        .sidebar a {
            color: #b0b0b0;
            text-decoration: none;
            padding: 0.7rem 1rem;
            display: block;
            border-radius: 8px;
            transition: all 0.3s;
            margin-bottom: 0.3rem;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.05);
            color: var(--accent-color);
        }

        .sidebar a.active {
            background: var(--accent-color);
            color: #0d0d0d;
            font-weight: 600;
            box-shadow: 0 0 25px var(--glow-color);
        }

        .sidebar .logout-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: #b0b0b0;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            width: 100%;
            text-align: left;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .sidebar .logout-btn:hover {
            background: rgba(255,0,0,0.1);
            border-color: #ff4444;
            color: #ff4444;
        }

        .main-content {
            padding: 2rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.5rem;
            transition: all 0.3s;
            backdrop-filter: blur(5px);
        }

        .card:hover {
            border-color: var(--accent-color);
            box-shadow: 0 0 30px var(--glow-color);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--accent-color);
            border: none;
            color: #0d0d0d;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            box-shadow: 0 0 30px var(--glow-color);
            transform: scale(1.02);
        }

        .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .btn-outline-secondary:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: #0d0d0d;
        }

        .progress {
            background: rgba(255,255,255,0.05);
            border-radius: 999px;
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            background: var(--accent-color);
            box-shadow: 0 0 20px var(--glow-color);
            border-radius: 999px;
        }

        .badge {
            background: var(--accent-color);
            color: #0d0d0d;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
        }

        .form-control, .form-select {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 8px;
            padding: 0.7rem 1rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 20px var(--glow-color);
            background: rgba(255,255,255,0.08);
            color: var(--text-color);
        }

        .form-control::placeholder {
            color: #666;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
            margin: 0 3px;
        }

        .color-option:hover {
            transform: scale(1.15);
        }

        .color-option.active {
            border-color: white;
            box-shadow: 0 0 15px rgba(255,255,255,0.3);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 999px;
        }

        .glow-text {
            color: var(--accent-color);
            text-shadow: 0 0 30px var(--glow-color);
        }

        .config-panel {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }
            .main-content {
                padding: 1rem;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar">
                <a href="{{ route('dashboard') }}" class="logo">EduSync</a>

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Resumen
                </a>
                <a href="{{ route('materias') }}" class="{{ request()->routeIs('materias') ? 'active' : '' }}">
                    Materias
                </a>
                <a href="{{ route('certificados') }}" class="{{ request()->routeIs('certificados') ? 'active' : '' }}">
                    Certificados
                </a>

                <hr style="border-color: var(--border-color);">

                <div class="config-panel">
                    <small style="color: #888;">Color de acento</small>
                    <div id="colorSelector" style="margin-top: 8px;">
                        <span class="color-option active" style="background: #f5a623;" data-color="#f5a623"></span>
                        <span class="color-option" style="background: #ff6b6b;" data-color="#ff6b6b"></span>
                        <span class="color-option" style="background: #ff6bff;" data-color="#ff6bff"></span>
                        <span class="color-option" style="background: #4ecdc4;" data-color="#4ecdc4"></span>
                        <span class="color-option" style="background: #45b7d1;" data-color="#45b7d1"></span>
                        <span class="color-option" style="background: #96ceb4;" data-color="#96ceb4"></span>
                        <span class="color-option" style="background: #ffcc00;" data-color="#ffcc00"></span>
                        <span class="color-option" style="background: #ff9500;" data-color="#ff9500"></span>
                        <span class="color-option" style="background: #ff2d55;" data-color="#ff2d55"></span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Cerrar sesión</button>
                </form>
            </nav>

            <main class="col-md-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.color-option').forEach(el => {
            el.addEventListener('click', function() {
                const color = this.dataset.color;
                document.querySelectorAll('.color-option').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                document.documentElement.style.setProperty('--accent-color', color);
                document.documentElement.style.setProperty('--glow-color', color + '40');

                localStorage.setItem('edusync_accent_color', color);
            });
        });

        const savedColor = localStorage.getItem('edusync_accent_color');
        if (savedColor) {
            document.documentElement.style.setProperty('--accent-color', savedColor);
            document.documentElement.style.setProperty('--glow-color', savedColor + '40');
            document.querySelectorAll('.color-option').forEach(el => {
                el.classList.toggle('active', el.dataset.color === savedColor);
                @yield('scripts')
            });
        }
    </script>
</body>
</html>