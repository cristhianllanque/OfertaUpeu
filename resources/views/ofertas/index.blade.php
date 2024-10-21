<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Lista de Ofertas</h1>

            @role('empresa|admin')
            <div class="mb-6">
                <a href="{{ route('ofertas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Crear Oferta
                </a>
            </div>
            @endrole

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-5">
                @foreach($ofertas as $oferta)
                    @php
                        $hoy = now()->toDateString();
                        $esVencida = $oferta->fecha_vencimiento < $hoy;
                    @endphp
                    <div class="bg-gray-50 border rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-700">{{ $oferta->titulo }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($oferta->descripcion, 80) }}</p>
                            <p class="text-gray-600 mt-2"><strong>Salario:</strong> {{ $oferta->salario }}</p>
                            <p class="text-gray-600 mt-2"><strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                            <p class="text-gray-600 mt-2"><strong>Empresa:</strong> {{ $oferta->creador->name }}</p> <!-- Mostrar el nombre de la empresa -->
                            <p class="text-gray-600 mt-2">
                                <strong>Fecha de Vencimiento:</strong> {{ $oferta->fecha_vencimiento }}
                                @if($esVencida)
                                    <span class="text-red-500 ml-2">Oferta Vencida</span>
                                @else
                                    <span class="text-green-500 ml-2">Vigente</span>
                                @endif
                            </p>
                        </div>
                        <div class="p-4 border-t flex justify-between">
                            <a href="{{ route('ofertas.show', $oferta->id) }}" class="text-blue-500 hover:underline">Ver Detalles</a>

                            @role('empresa|admin')
                                <a href="{{ route('ofertas.edit', $oferta->id) }}" class="text-yellow-500 hover:underline">Editar</a>

                                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta oferta?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                </form>
                            @endrole
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
