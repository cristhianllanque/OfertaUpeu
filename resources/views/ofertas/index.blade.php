<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-blue-500 pb-2 flex items-center">
                <i class="fas fa-briefcase mr-3 text-blue-500"></i> Lista de Ofertas
            </h1>

            @role('empresa|admin')
            <div class="mb-6">
                <a href="{{ route('ofertas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Crear Oferta
                </a>
            </div>
            @endrole

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4 flex items-center">
                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Campo de búsqueda -->
            <div class="mb-6 flex items-center">
                <i class="fas fa-search text-gray-400 mr-2"></i>
                <input type="text" id="search" placeholder="Buscar oferta por título..." class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
            </div>

            <!-- Lista de ofertas -->
            <div id="offers-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-5">
                @foreach($ofertas as $oferta)
                    @php
                        $hoy = now()->toDateString();
                        $esVencida = $oferta->fecha_vencimiento < $hoy;
                    @endphp
                    <div class="bg-gray-50 border rounded-lg p-6 shadow-lg transition-transform transform hover:scale-105 offer-item">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/default-offer-logo.png') }}" alt="Logo" class="w-16 h-16 rounded-full mr-4"> <!-- Logo por defecto -->
                            <h3 class="text-lg font-semibold text-gray-700 border-l-4 border-blue-300 pl-2 offer-title">{{ $oferta->titulo }}</h3>
                        </div>
                        <p class="text-gray-600 mt-2"><i class="fas fa-align-left mr-1"></i> {{ Str::limit($oferta->descripcion, 80) }}</p>
                        <p class="text-gray-600 mt-2"><i class="fas fa-dollar-sign mr-1"></i> <strong>Salario:</strong> {{ number_format($oferta->salario, 2) }} USD</p>
                        <p class="text-gray-600 mt-2"><i class="fas fa-map-marker-alt mr-1"></i> <strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                        <p class="text-gray-600 mt-2"><i class="fas fa-building mr-1"></i> <strong>Empresa:</strong> {{ $oferta->creador->name }}</p>
                        <p class="text-gray-600 mt-2 flex items-center">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            <strong>Fecha de Vencimiento:</strong> {{ $oferta->fecha_vencimiento }}
                            @if($esVencida)
                                <span class="text-red-500 ml-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Oferta Vencida
                                </span>
                            @else
                                <span class="text-green-500 ml-2 flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i> Vigente
                                </span>
                            @endif
                        </p>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('ofertas.show', $oferta->id) }}" class="text-blue-500 hover:underline" title="Ver Detalles">
                                <i class="fas fa-eye fa-lg"></i> <!-- Icono de ver -->
                            </a>

                            @role('empresa|admin')
                                <a href="{{ route('ofertas.edit', $oferta->id) }}" class="text-yellow-500 hover:underline" title="Editar">
                                    <i class="fas fa-edit fa-lg"></i> <!-- Icono de editar -->
                                </a>

                                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta oferta?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" title="Eliminar">
                                        <i class="fas fa-trash fa-lg"></i> <!-- Icono de eliminar -->
                                    </button>
                                </form>

                                <a href="{{ route('ofertas.reporte', $oferta->id) }}" class="text-green-500 hover:underline" title="Imprimir">
                                    <i class="fas fa-file-pdf fa-lg"></i> <!-- Icono de imprimir -->
                                </a>
                            @endrole
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Script para búsqueda en tiempo real -->
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let offers = document.querySelectorAll('.offer-item');
            
            offers.forEach(function(offer) {
                let title = offer.querySelector('.offer-title').textContent.toLowerCase();
                if (title.includes(searchQuery)) {
                    offer.style.display = 'block';
                } else {
                    offer.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
