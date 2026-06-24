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

        /* === TEXTO BLANCO FORZADO === */
        body, p, span, label, div, li, h1, h2, h3, h4, h5, small, strong, b, i, em,
        .text-muted, .card-text, .list-group-item, .week-label, .subject-info,
        .subject-pct, .description, .subtitle, .card-title, .subject-name,
        .form-control, .form-select, .badge, .btn, a:not(.btn):not(.nav-link) {
            color: #f0f0f0 !important;
        }

        /* Excepción para enlaces activos en el sidebar */
        .sidebar a.active {
            color: #0d0d0d !important;
        }

        /* Excepción para botones primarios */
        .btn-primary, .btn-primary * {
            color: #0d0d0d !important;
        }

        /* Excepción para badges */
        .badge, .badge * {
            color: #0d0d0d !important;
        }

        /* Placeholders de inputs */
        ::placeholder {
            color: #888 !important;
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

        .list-group-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
        }

        .btn-primary {
            background: var(--accent-color);
            border: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            box-shadow: 0 0 30px var(--glow-color);
            transform: scale(1.02);
        }

        .btn-secondary, .btn-outline-secondary {
            background: transparent;
            border-color: rgba(255,255,255,0.2);
        }

        .btn-secondary:hover, .btn-outline-secondary:hover {
            background: rgba(255,255,255,0.05);
            border-color: var(--accent-color);
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
            font-weight: 600;
            padding: 0.3rem 0.8rem;
        }

        .form-control, .form-select {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.7rem 1rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 20px var(--glow-color);
            background: rgba(255,255,255,0.08);
        }

        .form-control::placeholder {
            color: #666 !important;
        }

        .config-panel {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .config-panel small {
            color: #888;
        }

        .config-panel input[type="color"] {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 0;
            background: transparent;
        }

        .config-panel input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        .config-panel input[type="color"]::-webkit-color-swatch {
            border: 2px solid var(--border-color);
            border-radius: 50%;
        }

        .color-hex {
            color: #b0b0b0;
            font-size: 0.85rem;
            font-family: monospace;
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

        h1, h2, h3, h4, h5 {
            color: #ffffff !important;
        }

        footer, .footer, .site-footer {
            background: rgba(255,255,255,0.02);
            border-top: 1px solid rgba(255,255,255,0.05);
            color: #666;
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
                    <small>Color de acento</small>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                        <input type="color" id="accentColorPicker" value="#f5a623">
                        <span id="colorHexDisplay" class="color-hex">#f5a623</span>
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
        const colorPicker = document.getElementById('accentColorPicker');
        const colorDisplay = document.getElementById('colorHexDisplay');

        function applyColor(color) {
            document.documentElement.style.setProperty('--accent-color', color);
            document.documentElement.style.setProperty('--glow-color', color + '40');
            colorDisplay.textContent = color;
            localStorage.setItem('edusync_accent_color', color);
        }

        colorPicker.addEventListener('input', function() {
            applyColor(this.value);
        });

        const savedColor = localStorage.getItem('edusync_accent_color');
        if (savedColor) {
            colorPicker.value = savedColor;
            applyColor(savedColor);
        }
    </script>
</body>
</html>