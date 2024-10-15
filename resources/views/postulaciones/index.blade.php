<x-app-layout>
    <div class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-3xl font-extrabold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-briefcase text-purple-500 mr-3"></i> Lista de Postulaciones
                </h1>

                @if($postulaciones->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                        <p>No hay postulaciones registradas.</p>
                    </div>
                @else
                    <table class="table-auto w-full mt-5 bg-gray-50 rounded-lg shadow">
                        <thead class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white">
                            <tr>
                                <th class="px-4 py-3">Título de la Oferta</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Salario</th>
                                <th class="px-4 py-3">Ubicación</th>
                                <th class="px-4 py-3">Fecha de Vencimiento</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($postulaciones as $postulacion)
                                <tr class="bg-white hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <td class="border px-4 py-2 text-gray-700 font-medium">
                                        {{ $postulacion->oferta->titulo }}
                                    </td>
                                    <td class="border px-4 py-2 text-gray-600">
                                        {{ Str::limit($postulacion->oferta->descripcion, 50) }}
                                    </td>
                                    <td class="border px-4 py-2 text-gray-600">
                                        {{ $postulacion->oferta->salario }} USD
                                    </td>
                                    <td class="border px-4 py-2 text-gray-600">
                                        {{ $postulacion->oferta->ubicacion }}
                                    </td>
                                    <td class="border px-4 py-2 text-gray-600">
                                        {{ $postulacion->oferta->fecha_vencimiento }}
                                    </td>
                                    <td class="border px-4 py-2 text-gray-600">
                                        {{ ucfirst($postulacion->estado) }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('postulaciones.cancelar', $postulacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta postulación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                Cancelar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
