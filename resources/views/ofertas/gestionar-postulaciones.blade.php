<x-app-layout>
    <!-- Mensajes de éxito o alerta -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg shadow-md flex items-center animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('alert'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded-lg shadow-md flex items-center animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>{{ session('alert') }}</span>
        </div>
    @endif

    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tabla de postulaciones -->
            <div class="col-span-3 bg-white text-black p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-6 flex items-center">
 
                    Postulaciones Actuales
                </h1>

                @if($ofertas->isEmpty() || $ofertas->every(fn($oferta) => $oferta->postulaciones->isEmpty()))
                    <div class="bg-yellow-200 text-black p-4 rounded-lg">
                        <p>No hay postulantes para ninguna oferta actualmente.</p>
                    </div>
                @else
                    @foreach($ofertas as $oferta)
                        <div class="bg-blue-100 text-black p-4 mb-6 rounded-lg shadow-md hover:bg-blue-200 transition duration-300">
                            <h2 class="text-2xl font-semibold">{{ $oferta->titulo }}</h2>
                            <p class="text-sm text-gray-700">{{ $oferta->descripcion }}</p>
                            
                            <table class="table-auto w-full mt-4 text-left">
                                <thead>
                                    <tr class="text-sm uppercase text-gray-500">
                                        <th class="py-2">Postulante</th>
                                        <th class="py-2">Estado</th>
                                        <th class="py-2">CV</th>
                                        <th class="py-2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($oferta->postulaciones->isEmpty())
                                        <tr>
                                            <td colspan="4" class="py-4 text-gray-400">No hay postulantes.</td>
                                        </tr>
                                    @else
                                        @foreach($oferta->postulaciones as $postulacion)
                                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-150">
                                                <!-- Imagen de perfil aleatoria -->
                                                <td class="py-3 flex items-center">
                                                    <img src="https://i.pravatar.cc/50?img={{ rand(1,70) }}" class="rounded-full h-8 w-8 mr-2" alt="user">
                                                    <a href="{{ route('postulantes.ver', $postulacion->id) }}" class="text-blue-500 hover:underline">{{ $postulacion->user->name }}</a>
                                                </td>
                                                <td class="py-3 text-blue-600">
                                                    {{ ucfirst($postulacion->estado) }}
                                                </td>
                                                <!-- Link para ver el CV -->
                                                <td class="py-3">
                                                    @if($postulacion->user->archivo_cv)
                                                        <a href="{{ asset('storage/' . $postulacion->user->archivo_cv) }}" target="_blank" class="text-blue-500 hover:text-blue-700 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg> Ver CV
                                                        </a>
                                                    @else
                                                        <span class="text-gray-500">No disponible</span>
                                                    @endif
                                                </td>
                                                <!-- Formulario para cambiar el estado -->
                                                <td class="py-3">
                                                    <form action="{{ route('postulaciones.actualizar-estado', $postulacion->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="flex items-center">
                                                            <select name="estado" class="bg-white text-black border border-gray-300 rounded-md focus:border-blue-500 text-xs mr-2">
                                                                <option value="pendiente" {{ $postulacion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                                <option value="aceptado" {{ $postulacion->estado == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
                                                                <option value="rechazado" {{ $postulacion->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                                            </select>
                                                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition text-xs">
                                                                Guardar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
