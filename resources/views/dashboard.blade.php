<x-app-layout>
    <div class="min-h-screen bg-gradient-to-r from-blue-500 via-purple-600 to-indigo-500 py-10">
        <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">

            <!-- Encabezado general para todos los roles -->
            <div class="bg-gradient-to-r from-blue-700 to-purple-700 py-10 text-center text-white">
                <h1 class="text-5xl font-extrabold">¡Bienvenido a tu Panel!</h1>
                <p class="mt-3 text-xl font-medium">Aquí puedes gestionar tus opciones según tu rol.</p>
                <p class="mt-2 text-sm opacity-70">Tu experiencia personalizada te espera</p>
            </div>

            <!-- Contenido específico por roles -->
            <div class="px-10 py-6">
                @role('admin')
                    <!-- Vista para Administradores -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Panel del Administrador</h2>
                        <p class="text-lg text-gray-600 mb-6">Supervisa todas las ofertas, usuarios y estadísticas clave de la plataforma.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Estadísticas para Administrador con íconos -->
                        <div class="bg-blue-100 p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-4xl font-bold text-blue-600">50+</h3>
                            <p class="text-gray-800 mt-2">Ofertas Publicadas</p>
                        </div>
                        <div class="bg-green-100 p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-4xl font-bold text-green-600">150+</h3>
                            <p class="text-gray-800 mt-2">Postulantes Activos</p>
                        </div>
                        <div class="bg-yellow-100 p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-4xl font-bold text-yellow-600">20</h3>
                            <p class="text-gray-800 mt-2">Empresas Registradas</p>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center">
                        <a href="{{ route('usuarios.index') }}" class="bg-green-500 text-white px-8 py-3 rounded-full shadow-lg hover:bg-green-600 transform hover:scale-105 transition-all duration-300">
                            Gestionar Usuarios
                        </a>
                    </div>
                @endrole

                @role('empresa')
                    <!-- Vista para Empresas -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Panel de la Empresa</h2>
                        <p class="text-lg text-gray-600 mb-6">Gestiona tus ofertas de empleo y revisa tus postulaciones con facilidad.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Video instructivo para empresas -->
                        <div class="relative bg-gray-200 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                            <video class="w-full" autoplay muted loop>
                                <source src="{{ asset('videos/video3.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                                <h3 class="text-white text-2xl font-bold">Gestiona tus Ofertas</h3>
                            </div>
                        </div>

                        <!-- Botón para crear ofertas -->
                        <div class="bg-blue-100 p-6 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-xl font-bold text-gray-800">Publicar Nueva Oferta</h3>
                            <p class="text-gray-600 mt-4">Crea una nueva oferta de empleo y empieza a recibir postulaciones.</p>
                            <a href="{{ route('ofertas.create') }}" class="mt-6 bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600 transition-all duration-300 ease-in-out">
                                Crear Oferta
                            </a>
                        </div>
                    </div>
                @endrole

                @role('postulante')
                    <!-- Vista para Postulantes -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Panel del Postulante</h2>
                        <p class="text-lg text-gray-600 mb-6">Explora y postúlate a las ofertas de trabajo disponibles.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Botón para ver ofertas -->
                        <div class="bg-green-100 p-6 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-xl font-bold text-gray-800">Buscar Ofertas de Trabajo</h3>
                            <p class="text-gray-600 mt-4">Consulta las ofertas de trabajo disponibles y postúlate a las mejores.</p>
                            <a href="{{ route('ofertas.index') }}" class="mt-6 bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 transition-all duration-300 ease-in-out">
                                Ver Ofertas
                            </a>
                        </div>

                        <!-- Video Motivacional -->
                        <div class="relative bg-gray-200 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                            <video class="w-full" autoplay muted loop>
                                <source src="{{ asset('videos/video2.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                                <h3 class="text-white text-2xl font-bold">¡Encuentra el empleo de tus sueños!</h3>
                            </div>
                        </div>
                    </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
