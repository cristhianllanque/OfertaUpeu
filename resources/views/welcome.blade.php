<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero {
            position: relative;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Asegura que el video esté detrás del contenido */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-bar input {
            padding: 15px;
            width: 300px;
            border-radius: 30px;
            border: none;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding-left: 40px;
        }

        .search-bar button {
            background-color: #1e3a8a;
            color: white;
            border-radius: 30px;
            padding: 15px 30px;
            border: none;
            font-weight: bold;
        }

        .company-logos {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            justify-items: center;
            padding: 40px;
        }

        .company-logos img {
            width: 100px;
            height: auto;
        }

    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar py-4 px-10 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-blue-600">Upeu</h1>
        </div>
        <div class="flex space-x-6">
            <a href="#" class="text-gray-600">Buscar ofertas</a>
            <a href="#" class="text-gray-600">Evaluaciones de empresa</a>
            <a href="#" class="text-gray-600">Salarios</a>
            <a href="#" class="text-gray-600">Desarrollo profesional</a>
        </div>
        <div>
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 mr-4">INICIAR SESIÓN</a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">REGISTRAR</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <!-- Video de fondo -->
        <video autoplay muted loop class="absolute w-full h-full object-cover">
            <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>

        <div class="overlay"></div>

        <div class="hero-content">
            <h1 class="text-4xl font-bold mb-6">¡Ahora es el momento de cambiar!</h1>
            <p class="mb-6 text-xl">Encuentra el empleo que encaja contigo, más de <span class="font-bold">47,255</span> ofertas</p>
            <div class="search-bar">
                <input type="text" placeholder="Cargo o categoría">
                <input type="text" placeholder="Lugar">
                <button>Buscar empleos</button>
            </div>
        </div>
    </section>

    <!-- Empresa Section -->
    <section class="bg-white py-10">
        <div class="text-center">
            <p class="text-lg">Hoy hay <span class="font-bold">9,080</span> empresas contratando con las mejores vacantes para ti</p>
        </div>
        <div class="company-logos">

            <img src="{{ asset('imgs/logo1.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo2.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo3.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo4.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo5.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo6.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo7.png') }}" alt="logo">
            <img src="{{ asset('imgs/logo8.png') }}" alt="logo">
        </div>
    </section>

</body>
</html>
