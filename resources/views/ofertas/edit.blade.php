<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-300 shadow overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-blue-500 pb-2">Editar Oferta</h1>

            <form action="{{ route('ofertas.update', $oferta->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Contenedor de dos columnas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Columna izquierda -->
                    <div>
                        <!-- Campo de Título -->
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="titulo" id="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $oferta->titulo }}">
                            @error('titulo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $oferta->descripcion }}</textarea>
                            @error('descripcion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Salario -->
                        <div class="mb-4">
                            <label for="salario" class="block text-sm font-medium text-gray-700">Salario</label>
                            <input type="text" name="salario" id="salario" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $oferta->salario }}">
                            @error('salario')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div>
                        <!-- Campo de Ubicación -->
                        <div class="mb-4">
                            <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $oferta->ubicacion }}">
                            @error('ubicacion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Fecha y Hora de Inicio -->
                        <div class="mb-4">
                            <label for="fecha_hora_inicio" class="block text-sm font-medium text-gray-700">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" name="fecha_hora_inicio" id="fecha_hora_inicio" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                value="{{ old('fecha_hora_inicio', optional($oferta->fecha_hora_inicio)->format('Y-m-d\TH:i')) }}">
                            @error('fecha_hora_inicio')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Fecha y Hora de Fin -->
                        <div class="mb-4">
                            <label for="fecha_hora_fin" class="block text-sm font-medium text-gray-700">Fecha y Hora de Fin</label>
                            <input type="datetime-local" name="fecha_hora_fin" id="fecha_hora_fin" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                value="{{ old('fecha_hora_fin', optional($oferta->fecha_hora_fin)->format('Y-m-d\TH:i')) }}">
                            @error('fecha_hora_fin')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Fecha de Vencimiento -->
                        <div class="mb-4">
                            <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700">Fecha de Vencimiento</label>
                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                value="{{ $oferta->fecha_vencimiento }}">
                            @error('fecha_vencimiento')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end mt-6">
                    <a href="{{ route('ofertas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700">Cancelar</a>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
