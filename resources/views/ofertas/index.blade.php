<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-b from-blue-200 to-white shadow-xl overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-700 mb-6">Lista de Ofertas</h1>

            @role('empresa|admin')
            <div class="mb-6">
                <a href="{{ route('ofertas.create') }}" class="bg-blue-500 text-white px-5 py-3 rounded-full hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear Oferta
                </a>
            </div>
            @endrole

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-5">
                @foreach($ofertas as $oferta)
                    @php
                        $hoy = now()->toDateString();
                        $esVencida = $oferta->fecha_vencimiento < $hoy;
                    @endphp
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $oferta->titulo }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($oferta->descripcion, 80) }}</p>
                            <p class="text-gray-600 mt-2"><strong>Salario:</strong> {{ $oferta->salario }}</p>
                            <p class="text-gray-600 mt-2"><strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                            <p class="text-gray-600 mt-2">
                                <strong>Fecha de Vencimiento:</strong> {{ $oferta->fecha_vencimiento }}
                                @if($esVencida)
                                    <span class="text-red-500 ml-2 font-bold">Oferta Vencida</span>
                                @else
                                    <span class="text-green-500 ml-2 font-bold">Vigente</span>
                                @endif
                            </p>
                        </div>
                        <div class="p-4 bg-gray-100 flex justify-between items-center">
                            <a href="{{ route('ofertas.show', $oferta->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-700 transition-all duration-300 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Ver Detalles
                            </a>

                            @role('empresa|admin')
                                <a href="{{ route('ofertas.edit', $oferta->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-700 transition-all duration-300 ease-in-out flex items-center">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4H8m5-4h.01M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                    Editar
                                </a>

                                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta oferta?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-700 transition-all duration-300 ease-in-out flex items-center">
                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            @endrole
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
