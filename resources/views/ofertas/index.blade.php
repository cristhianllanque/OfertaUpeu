<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl overflow-hidden sm:rounded-lg p-6 border-t-4 border-yellow-600">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-yellow-500 pb-2 flex items-center">
                <i class="fas fa-briefcase mr-3 text-yellow-500"></i> Lista de Ofertas
            </h1>

            <!-- Botón para crear ofertas, solo visible para empresa y admins -->
            @role('empresa|admin')
            <div class="mb-6">
                <a href="{{ route('ofertas.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 flex items-center transition duration-300">
                    <i class="fas fa-plus mr-2"></i> Crear Oferta
                </a>
            </div>
            @endrole

            <!-- Mensajes de éxito o error -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg shadow-md mb-4 flex items-center">
                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg shadow-md mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Campo de búsqueda -->
            <div class="mb-6 flex items-center bg-gray-100 rounded-lg shadow-inner p-2">
                <i class="fas fa-search text-gray-500 mr-2"></i>
                <input type="text" id="search" placeholder="Buscar oferta por título..." class="w-full px-4 py-2 border-none rounded-lg bg-transparent focus:ring focus:ring-yellow-300 focus:outline-none">
            </div>

            <!-- Lista de ofertas -->
            <div id="offers-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-5">
                @foreach($ofertas as $oferta)
                    @php
                        $hoy = now();
                        $esFutura = $oferta->fecha_hora_inicio > $hoy;
                        $tiempoRestante = $oferta->fecha_hora_inicio->diffForHumans($hoy);
                    @endphp
                    <div class="relative bg-gray-50 border rounded-lg p-6 shadow-lg transition-transform transform hover:scale-105 offer-item {{ $esFutura ? 'bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-400 border-yellow-500' : '' }}">
                        <!-- Etiqueta visual para ofertas futuras -->
                        @if($esFutura)
                            <div class="absolute top-0 right-0 px-3 py-1 rounded-bl-lg text-white font-bold bg-red-600">
                                Próximamente
                            </div>
                        @endif

                        <!-- Detalles básicos de la oferta -->
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/default-offer-logo.png') }}" alt="Logo" class="w-16 h-16 rounded-full mr-4 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700 border-l-4 border-yellow-300 pl-2 offer-title">{{ $oferta->titulo }}</h3>
                        </div>

                        <p class="text-gray-600 mt-2"><i class="fas fa-align-left mr-1"></i> {{ Str::limit($oferta->descripcion, 80) }}</p>
                        <p class="text-gray-600 mt-2"><i class="fas fa-dollar-sign mr-1"></i> <strong>Salario:</strong> {{ number_format($oferta->salario, 2) }} USD</p>
                        <p class="text-gray-600 mt-2"><i class="fas fa-map-marker-alt mr-1"></i> <strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                        <p class="text-gray-600 mt-2"><i class="fas fa-building mr-1"></i> <strong>Empresa:</strong> {{ $oferta->creador->name }}</p>

                        <!-- Mensaje si la oferta es futura -->
                        @if($esFutura)
                            <p class="text-yellow-800 font-bold mt-2 flex items-center">
                                <i class="fas fa-hourglass-half mr-1"></i>
                                <strong>Disponible en:</strong> {{ $tiempoRestante }}
                            </p>
                        @else
                            <!-- Fecha de vencimiento y estado -->
                            <p class="text-gray-600 mt-2 flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <strong>Fecha de Vencimiento:</strong> {{ $oferta->fecha_vencimiento }}
                                @if($oferta->fecha_vencimiento < $hoy)
                                    <span class="text-red-500 ml-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Oferta Vencida
                                    </span>
                                @else
                                    <span class="text-green-500 ml-2 flex items-center">
                                        <i class="fas fa-check-circle mr-1"></i> Vigente
                                    </span>
                                @endif
                            </p>
                        @endif

                        <!-- Acciones para empresas y admins -->
                        <div class="flex justify-between mt-4">
                            @if($oferta->puede_ver_detalles || auth()->user()->hasRole('empresa|admin'))
                                <a href="{{ route('ofertas.show', $oferta->id) }}" class="text-yellow-500 hover:underline" title="Ver Detalles">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            @else
                                <p class="text-red-500">No disponible aún (habilitada en {{ $tiempoRestante }})</p>
                            @endif

                            @role('empresa|admin')
                                <a href="{{ route('ofertas.edit', $oferta->id) }}" class="text-yellow-500 hover:underline" title="Editar">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>

                                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta oferta?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" title="Eliminar">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>

                                <a href="{{ route('ofertas.reporte', $oferta->id) }}" class="text-green-500 hover:underline" title="Imprimir">
                                    <i class="fas fa-file-pdf fa-lg"></i>
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
