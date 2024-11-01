<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-300 shadow overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-blue-500 pb-2">Crear Oferta</h1>

            <form action="{{ route('ofertas.store') }}" method="POST">
                @csrf
                
                <!-- Contenedor de dos columnas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Columna izquierda -->
                    <div>
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="titulo" id="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('titulo') }}">
                            @error('titulo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="salario" class="block text-sm font-medium text-gray-700">Salario</label>
                            <input type="text" name="salario" id="salario" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('salario') }}">
                            @error('salario')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div>
                        <div class="mb-4">
                            <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('ubicacion') }}">
                            @error('ubicacion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700">Fecha de Vencimiento</label>
                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('fecha_vencimiento') }}">
                            @error('fecha_vencimiento')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para la fecha y hora de inicio de la oferta -->
                        <div class="mb-4">
                            <label for="fecha_hora_inicio" class="block text-sm font-medium text-gray-700">Fecha y hora de inicio</label>
                            <input type="datetime-local" name="fecha_hora_inicio" id="fecha_hora_inicio" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                value="{{ old('fecha_hora_inicio') }}">
                            @error('fecha_hora_inicio')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para la fecha y hora de fin de la oferta -->
                        <div class="mb-4">
                            <label for="fecha_hora_fin" class="block text-sm font-medium text-gray-700">Fecha y hora de fin</label>
                            <input type="datetime-local" name="fecha_hora_fin" id="fecha_hora_fin" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                value="{{ old('fecha_hora_fin') }}">
                            @error('fecha_hora_fin')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end mt-6">
                    <a href="{{ route('ofertas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700">Cancelar</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
