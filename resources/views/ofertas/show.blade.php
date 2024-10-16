<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-blue-100 to-gray-50 shadow-lg sm:rounded-lg p-6 transition-all duration-300 hover:shadow-2xl">
            <h1 class="text-4xl font-extrabold text-gray-700 mb-6 flex items-center">
                <svg class="w-8 h-8 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                </svg>
                {{ $oferta->titulo }}
            </h1>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 flex items-center animate-bounce">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Mensaje de alerta si ya está postulado -->
            @if (session('alert'))
                <div class="bg-red-500 text-white p-4 rounded mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('alert') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700">Descripción:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->descripcion }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700">Salario:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->salario }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700">Ubicación:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->ubicacion }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700">Fecha de Vencimiento:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->fecha_vencimiento }}</p>
                </div>
            </div>

            <!-- Botón de Postularse (visible solo para postulantes) -->
            @role('postulante')
            <form action="{{ route('postularse', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas postularte a esta oferta?');">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Postularse
                </button>
            </form>
            @endrole

            <div class="flex justify-end mt-8">
                <a href="{{ route('ofertas.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-full hover:bg-gray-700 transition-all duration-300 ease-in-out flex items-center transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0v6m0-6V6" />
                    </svg>
                    Regresar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
