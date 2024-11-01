<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}">

    <style>
        /* Video de fondo para el contenido principal */
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.5;
        }

        /* Video de fondo para el menú lateral */
        #menu-bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.3;
        }

        /* Ajuste de contenido para estar por encima del video */
        .content {
            position: relative;
            z-index: 1;
        }

        /* Fondo transparente pero legible */
        .bg-white, .bg-gray-500, .bg-yellow-500, .bg-yellow-100 {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(5px);
        }

        /* Ajustar el color de los botones para que no se oculten */
        .text-white {
            color: #ffffff !important;
        }
        .hover\:bg-yellow-600:hover {
            background-color: #d4af37 !important;
        }
        .hover\:bg-gray-700:hover {
            background-color: #6b7280 !important;
        }

        /* Colores dorados para el menú y los enlaces */
        .bg-yellow-500 {
            background-color: #d4af37;
        }
        .hover\:bg-yellow-600:hover {
            background-color: #c99b33;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <x-banner />

    <!-- Video de fondo principal -->
    <video id="bg-video" autoplay muted loop>
        <source src="{{ asset('videos/fondo.mp4') }}" type="video/mp4">
        Tu navegador no soporta videos.
    </video>

    <div class="flex min-h-screen">
        <!-- Sidebar Menu con diseño fijo y video de fondo -->
        <aside class="w-64 bg-gradient-to-b from-yellow-300 via-yellow-400 to-yellow-500 text-white min-h-screen flex flex-col fixed">
            <!-- Video de fondo del menú lateral -->
            <video id="menu-bg-video" autoplay muted loop>
                <source src="{{ asset('videos/fondo2.mp4') }}" type="video/mp4">
                Tu navegador no soporta videos.
            </video>

            <!-- Logo -->
            <div class="flex items-center justify-center py-6 relative">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto">
            </div>

            <!-- Navigation Links con iconos y fondo dorado -->
            <nav class="flex flex-col space-y-4 px-6 relative z-10">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-lg {{ request()->routeIs('dashboard') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                    <i class="fas fa-tachometer-alt fa-lg mr-3"></i> {{ __('Dashboard') }}
                </x-nav-link>

                @role('admin')
                <x-nav-link href="{{ route('usuarios.index') }}" :active="request()->routeIs('usuarios.index')" class="text-lg {{ request()->routeIs('usuarios.index') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                    <i class="fas fa-users fa-lg mr-3"></i> {{ __('Usuarios') }}
                </x-nav-link>
                @endrole

                @role('empresa')
                <x-nav-link href="{{ route('ofertas.index') }}" :active="request()->routeIs('ofertas.index')" class="text-lg {{ request()->routeIs('ofertas.index') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                    <i class="fas fa-briefcase fa-lg mr-3"></i> {{ __('Ofertas') }}
                </x-nav-link>
                <x-nav-link href="{{ route('gestionar-postulaciones') }}" :active="request()->routeIs('gestionar-postulaciones')" class="text-lg {{ request()->routeIs('gestionar-postulaciones') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                    <i class="fas fa-tasks fa-lg mr-3"></i> {{ __('Gestionar Postulaciones') }}
                </x-nav-link>
                @endrole

                @role('postulante')
                <x-nav-link href="{{ route('ofertas.index') }}" :active="request()->routeIs('ofertas.index')" class="text-lg {{ request()->routeIs('ofertas.index') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                    <i class="fas fa-search fa-lg mr-3"></i> {{ __('Ver Ofertas') }}
                </x-nav-link>
                <x-nav-link href="{{ route('mis-postulaciones') }}" :active="request()->routeIs('mis-postulaciones')" class="text-lg {{ request()->routeIs('mis-postulaciones') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                    <i class="fas fa-file-alt fa-lg mr-3"></i> {{ __('Mis Postulaciones') }}
                </x-nav-link>
                @endrole

                <!-- Profile & Logout -->
                <div class="mt-auto border-t border-yellow-400 pt-4">
                    <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-lg {{ request()->routeIs('profile.show') ? 'bg-yellow-600 text-white' : 'text-white' }} hover:bg-yellow-600 p-3 rounded-lg transition">
                        <i class="fas fa-user fa-lg mr-3"></i> {{ __('Perfil') }}
                    </x-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link href="{{ route('logout') }}" class="text-lg hover:bg-yellow-600 p-3 rounded-lg transition"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt fa-lg mr-3"></i> {{ __('Cerrar Sesión') }}
                        </x-nav-link>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content ajustado a la nueva barra lateral fija -->
        <div class="flex-1 ml-64 content">
            <!-- Top Bar fija con estilo y avatar aleatorio -->
            <header class="bg-yellow-500 text-white shadow fixed w-full z-10">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <!-- Bienvenida con avatar aleatorio -->
                    <div class="flex items-center">
                        <img src="https://i.pravatar.cc/150?u={{ Auth::user()->email }}" alt="Avatar" class="h-10 w-10 rounded-full mr-3">
                        <h2 class="font-semibold text-2xl leading-tight">
                            {{ __('Bienvenido, '. Auth::user()->name) }}
                        </h2>
                    </div>

                    <!-- Opción de perfil y cerrar sesión en la barra superior -->
                    <div class="flex items-center space-x-4">
                        <x-nav-link href="{{ route('profile.show') }}" class="text-white hover:text-gray-200">
                            <i class="fas fa-user-cog fa-lg mr-1"></i> {{ __('Perfil') }}
                        </x-nav-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link href="{{ route('logout') }}" class="text-white hover:text-gray-200"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt fa-lg mr-1"></i> {{ __('Cerrar Sesión') }}
                            </x-nav-link>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Ajustar el espacio del contenido principal para la barra fija -->
            <main class="p-8 mt-16">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
</body>
</html>
