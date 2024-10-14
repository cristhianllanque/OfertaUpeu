<x-app-layout>
    <div class="max-w-7xl mx-auto py-12">
        <div class="bg-white shadow-xl sm:rounded-lg p-8">
            <h1 class="text-3xl font-semibold text-blue-700 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16z"/>
                </svg>
                Detalles del Postulante
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Información del postulante -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Datos del Postulante</h2>
                    <p class="flex items-center text-lg mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <strong>Nombre:</strong> {{ $postulacion->user->name }}
                    </p>
                    <p class="flex items-center text-lg mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 8V7l-3 2-2-1v6l2 1 3-2v-1l2 1v2l-3 2-3-1-4 1V6l4 1 3-1 3 2v1l-2-1-3 2zM7 12V6l-4 1-3-2v6l2 1v4l-2 1v2l3-1 4 1 1-1v-4l-1-1zm0 5-3-2v-2l3 1v3zm0-4-3-1v-3l3 1v3z"/>
                        </svg>
                        <strong>Email:</strong> {{ $postulacion->user->email }}
                    </p>
                    <p class="flex items-center text-lg mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 10c0-2.76-2.24-5-5-5S7 7.24 7 10c0 3.92 5 9 5 9s5-5.08 5-9zm-5 3c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3z"/>
                        </svg>
                        <strong>Celular:</strong> {{ $postulacion->user->celular }}
                    </p>
                    <p class="flex items-center text-lg mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 14v2h-6v-2h6m2-2H2v10h20V12m-6-7v2h-2v2h2v2h-2v2h2v2h-2v2h2v2h-2v-8c0-1.1-.9-2-2-2H6c-1.1 0-2 .9-2 2v2H2v-4h2v-4H2V4h4v2h6V4h2v2h6V4h2v2h-2v6h2V6m-6 10v2h-2v-2h2z"/>
                        </svg>
                        <strong>DNI:</strong> {{ $postulacion->user->dni }}
                    </p>
                    @if ($postulacion->user->archivo_cv)
                        <p class="flex items-center text-lg mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-4.41 3.59-8 8-8 4.41 0 8 3.59 8 8 0 4.41-3.59 8-8 8zm-4-4v-2h8v2H8zm4-10v4h-2l3-4V6h-1z"/>
                            </svg>
                            <strong>CV:</strong> <a href="{{ asset('storage/' . $postulacion->user->archivo_cv) }}" target="_blank" class="text-blue-500 hover:text-blue-700">Ver CV</a>
                        </p>
                    @else
                        <p><strong>CV:</strong> No disponible</p>
                    @endif
                </div>

                <!-- Información de la oferta -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles de la Oferta</h2>
                    <p class="text-lg mb-2"><strong>Título:</strong> {{ $postulacion->oferta->titulo }}</p>
                    <p class="text-lg mb-2"><strong>Descripción:</strong> {{ $postulacion->oferta->descripcion }}</p>
                    <p class="text-lg mb-2"><strong>Salario:</strong> {{ $postulacion->oferta->salario }}</p>
                    <p class="text-lg mb-2"><strong>Ubicación:</strong> {{ $postulacion->oferta->ubicacion }}</p>
                    <p class="text-lg mb-2"><strong>Fecha de vencimiento:</strong> {{ $postulacion->oferta->fecha_vencimiento }}</p>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="mt-8 flex space-x-4">
                <form action="{{ route('postulaciones.actualizar-estado', $postulacion->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="estado" value="aceptado">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2zm-1 15l7-7-1.41-1.42L11 14.17l-3.59-3.59L6 12l5 5z"/>
                        </svg>
                        Aceptar Postulación
                    </button>
                </form>

                <a href="{{ route('gestionar-postulaciones') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 4c4.41 0 8 3.59 8 8s-3.59 8-8 8-8-3.59-8-8 3.59-8 8-8zm0 14l5-5H7l5 5zm0-10v5H7l5-5z"/>
                    </svg>
                    Volver a la Gestión de Postulaciones
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
