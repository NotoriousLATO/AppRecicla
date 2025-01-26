<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Plataforma de Reciclaje')</title>
    <!-- Fuentes y estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Estilos generales */
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Barra de navegación */
        .navbar {
            background-color:rgb(110, 176, 125);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }
        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .logo {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            letter-spacing: 1px;
        }
        .menu-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            background: none;
            border: none;
            color: #fff;
        }
        .navbar-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .navbar-menu li {
            display: inline-block;
        }
        .navbar-menu a {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s ease;
        }
        .navbar-menu a:hover {
            background-color:rgb(129, 211, 146);
        }
        .navbar-logout {
            background-color: #dc3545;
            border: none;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .navbar-logout:hover {
            background-color: #c82333;
        }

        /* Contenido principal */
        .main-content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 30px 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para la barra de navegación en pantallas pequeñas */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            .navbar-menu {
                display: none;
                flex-direction: column;
                gap: 10px;
                background-color:rgb(8, 126, 35);
                padding: 10px 15px;
                position: absolute;
                top: 60px;
                right: 20px;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }
            .navbar-menu.active {
                display: flex;
            }
            .navbar-menu li {
                text-align: left;
            }
        }

        /* Transición suave para el menú */
        .navbar-menu {
            transition: all 0.3s ease-in-out;
        }
    </style>
    @yield('head')
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="logo">ReciclaYa</a>
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="navbar-menu" id="navbarMenu">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li><a href="{{ route('oferta.index') }}">Ofertas</a></li>
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="navbar-logout">Cerrar sesión</button>
                        </form>
                    </li>
                @else
                    @if (!request()->is('login') && !request()->is('register'))
                        <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Contenido de la vista -->
    <div class="main-content">
        @yield('content')
    </div>

    <script>
        // Activa el menú al hacer clic en el icono de menú
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('navbarMenu').classList.toggle('active');
        });
    </script>
</body>
</html>
