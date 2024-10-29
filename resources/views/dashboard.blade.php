<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto">

            <!-- Encabezado general -->
            <div class="bg-white shadow-xl rounded-lg mb-10 p-6 text-center">
                <h1 class="text-5xl font-bold text-gray-800 mb-4">Panel de Control</h1>
                <p class="text-lg text-gray-600">Administra todas las acciones importantes desde aquí.</p>
            </div>

            <!-- Contenido según el rol del usuario -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @role('admin')
                <!-- Panel para el Administrador -->
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 col-span-2">
                    <h2 class="text-3xl font-semibold text-gray-800">Métricas Generales</h2>
                    <p class="mt-2 text-gray-600">Monitorea las estadísticas clave de la plataforma</p>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="bg-blue-100 text-blue-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">120</h3>
                            <p class="text-sm">Ofertas Activas</p>
                        </div>
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">250</h3>
                            <p class="text-sm">Usuarios Registrados</p>
                        </div>
                        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">35</h3>
                            <p class="text-sm">Empresas Registradas</p>
                        </div>
                    </div>
                    <a href="{{ route('usuarios.index') }}" class="mt-6 block bg-blue-500 text-white text-center py-3 rounded-md hover:bg-blue-600">
                        <i class="fas fa-users mr-2"></i> Gestionar Usuarios
                    </a>
                    <a href="{{ route('ofertas.index') }}" class="mt-3 block bg-green-500 text-white text-center py-3 rounded-md hover:bg-green-600">
                        <i class="fas fa-briefcase mr-2"></i> Gestionar Ofertas
                    </a>
                </div>

                <!-- Nueva sección de estadísticas visuales -->
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-4">Estadísticas Visuales</h2>
                    <div class="space-y-4">
                        <!-- Ejemplo de gráfico circular (Relleno de ejemplo visual) -->
                        <div class="relative w-full h-40">
                            <svg class="w-full h-full">
                                <circle class="text-gray-300" stroke-width="8" stroke="currentColor" fill="transparent" r="50%" cx="50%" cy="50%"></circle>
                                <circle class="text-blue-500" stroke-width="8" stroke-dasharray="150,100" stroke-linecap="round" stroke="currentColor" fill="transparent" r="50%" cx="50%" cy="50%"></circle>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-3xl font-bold text-blue-600">75%</span>
                            </div>
                        </div>
                        <p class="text-gray-600 text-center">Usuarios Activos</p>

                        <!-- Otro gráfico simple de barras -->
                        <div class="w-full bg-gray-200 h-6 rounded-lg overflow-hidden">
                            <div class="bg-green-500 h-full" style="width: 60%;"></div>
                        </div>
                        <p class="text-gray-600 text-center">Postulaciones Completadas</p>

                        <!-- Simulación de una métrica adicional -->
                        <div class="w-full bg-gray-200 h-6 rounded-lg overflow-hidden">
                            <div class="bg-yellow-500 h-full" style="width: 80%;"></div>
                        </div>
                        <p class="text-gray-600 text-center">Empresas Activas</p>
                    </div>
                </div>
                @endrole

                @role('empresa')
                <!-- Panel para Empresas -->
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 col-span-2">
                    <h2 class="text-3xl font-semibold text-gray-800">Gestión de Ofertas</h2>
                    <p class="mt-2 text-gray-600">Publica y gestiona tus ofertas de empleo</p>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="bg-indigo-100 text-indigo-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">15</h3>
                            <p class="text-sm">Ofertas Publicadas</p>
                        </div>
                        <div class="bg-gray-100 text-gray-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">50</h3>
                            <p class="text-sm">Postulantes Recibidos</p>
                        </div>
                    </div>
                    <a href="{{ route('ofertas.create') }}" class="mt-6 block bg-indigo-500 text-white text-center py-3 rounded-md hover:bg-indigo-600">
                        <i class="fas fa-plus mr-2"></i> Crear Nueva Oferta
                    </a>
                    <a href="{{ route('ofertas.index') }}" class="mt-3 block bg-gray-500 text-white text-center py-3 rounded-md hover:bg-gray-600">
                        <i class="fas fa-users mr-2"></i> Ver Postulantes
                    </a>
                </div>
                @endrole

                @role('postulante')
                <!-- Panel para Postulantes -->
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 col-span-2">
                    <h2 class="text-3xl font-semibold text-gray-800">Oportunidades de Empleo</h2>
                    <p class="mt-2 text-gray-600">Encuentra y postúlate a las mejores ofertas</p>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">20+</h3>
                            <p class="text-sm">Ofertas Disponibles</p>
                        </div>
                        <div class="bg-red-100 text-red-800 p-4 rounded-lg shadow-md text-center w-full mx-1">
                            <h3 class="text-4xl font-bold">5</h3>
                            <p class="text-sm">Postulaciones Activas</p>
                        </div>
                    </div>
                    <a href="{{ route('ofertas.index') }}" class="mt-6 block bg-green-500 text-white text-center py-3 rounded-md hover:bg-green-600">
                        <i class="fas fa-briefcase mr-2"></i> Ver Ofertas Disponibles
                    </a>
                    <a href="{{ route('postulaciones.index') }}" class="mt-3 block bg-red-500 text-white text-center py-3 rounded-md hover:bg-red-600">
                        <i class="fas fa-envelope-open-text mr-2"></i> Ver Mis Postulaciones
                    </a>
                </div>
                @endrole

            </div>
        </div>
    </div>
</x-app-layout>
