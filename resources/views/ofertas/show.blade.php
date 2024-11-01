<x-app-layout>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-blue-100 to-gray-50 shadow-lg sm:rounded-lg p-6 transition-all duration-300 hover:shadow-2xl relative">
            <h1 class="text-4xl font-extrabold text-gray-700 mb-6 flex items-center">
                <svg class="w-8 h-8 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                </svg>
                {{ $oferta->titulo }}
            </h1>

            <!-- Mensaje de éxito usando SweetAlert2 -->
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                        position: 'top-end',
                        background: '#e6ffed',
                        color: '#2f855a'
                    });
                </script>
            @endif

            <!-- Mensaje de alerta usando SweetAlert2 -->
            @if (session('alert'))
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: '{{ session('alert') }}',
                        showConfirmButton: true,
                        confirmButtonText: 'Entendido',
                        background: '#fff4e6',
                        color: '#d97706',
                    });
                </script>
            @endif

            <!-- Detalles de la oferta -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Descripción:
                    </strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->descripcion }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0-1C9.79 7 8 8.79 8 11s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
                        </svg>
                        Salario:
                    </strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->salario }} USD</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 9h6M9 13h6" />
                        </svg>
                        Ubicación:
                    </strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->ubicacion }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                        </svg>
                        Fecha de Vencimiento:
                    </strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->fecha_vencimiento }}</p>
                </div>
            </div>

            <!-- Botones de Postularse y Regresar -->
            <div class="flex flex-col space-y-4">
                @if ($puedePostularse)
                    <!-- Botón de postulación -->
                    @role('postulante')
                    <form action="{{ route('postularse', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas postularte a esta oferta?');">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Postularse
                        </button>
                    </form>
                    @endrole
                @else
                    <!-- Mensaje de espera -->
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow flex items-center space-x-2">
                        <i class="fas fa-clock mr-2"></i>
                        <span>La postulación estará disponible en {{ $oferta->fecha_hora_inicio->diffForHumans() }}.</span>
                    </div>
                @endif

                <!-- Botón Regresar -->
                <a href="{{ route('ofertas.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-700 transition-all duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0v6m0-6V6" />
                    </svg>
                    Regresar
                </a>
               <!-- Botón Regresar -->



            </div>
        </div>
    </div>
</x-app-layout>
