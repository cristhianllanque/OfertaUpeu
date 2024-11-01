<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12" style="background-image: url('{{ asset('images/texture.jpg') }}'); background-size: cover; background-blend-mode: multiply;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-lg p-6" style="border: 2px solid #8B4513;">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-briefcase text-yellow-600 mr-3"></i> Mis Postulaciones
                </h1>

                @if($postulaciones->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-600 text-yellow-700 p-4 rounded-lg shadow-md" role="alert">
                        <p>No te has postulado a ninguna oferta todavía.</p>
                    </div>
                @else
                    <!-- Barra de búsqueda con estilo rústico -->
                    <div class="mb-4">
                        <input type="text" id="search" placeholder="Buscar por título..." class="w-full px-4 py-3 rounded-lg shadow-md border-none focus:ring focus:ring-yellow-200 focus:outline-none bg-gray-100 text-gray-700 placeholder-gray-500" style="border: 1px solid #8B4513;">
                    </div>

                    <!-- Generar Reporte -->
                    <div class="mb-6 text-right">
                        <a href="{{ route('postulaciones.reporte') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-700 transition duration-200 ease-in-out transform hover:scale-105">
                            Generar Reporte General
                        </a>
                    </div>
                    
                    <!-- Tabla de postulaciones con un diseño más robusto y terroso -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($postulaciones as $postulacion)
                        <div class="bg-gradient-to-r from-gray-100 to-gray-200 rounded-lg shadow-2xl p-6 transition-all hover:shadow-2xl hover:scale-105 border-t-4 border-yellow-700">
                            <div class="mb-4">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $postulacion->oferta->titulo }}</h2>
                                <p class="text-gray-600"><i class="fas fa-map-marker-alt text-yellow-600"></i> {{ $postulacion->oferta->ubicacion }}</p>
                            </div>
                            <p class="text-gray-700"><strong>Salario:</strong> {{ number_format($postulacion->oferta->salario, 2) }} USD</p>
                            <p class="text-gray-700"><strong>Fecha de Vencimiento:</strong> {{ $postulacion->oferta->fecha_vencimiento }}</p>
                            <p class="text-gray-700"><strong>Estado:</strong> {{ ucfirst($postulacion->estado) }}</p>
                            <p class="text-gray-700"><strong>Postulado el:</strong> {{ $postulacion->created_at->setTimezone('America/Lima')->format('Y-m-d H:i:s') }}</p>

                            <div class="flex justify-end mt-4">
                                <form action="{{ route('postulaciones.cancelar', $postulacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta postulación?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-800 transition duration-200 ease-in-out transform hover:scale-105">
                                        Cancelar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Script para búsqueda en tiempo real -->
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let rows = document.querySelectorAll('.grid .bg-gradient-to-r');
            
            rows.forEach(function(row) {
                let title = row.querySelector('h2').textContent.toLowerCase();
                if (title.includes(searchQuery)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
