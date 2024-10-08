<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Postulaciones para {{ $oferta->titulo }}</h1>

            <table class="table-auto w-full mt-5">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Postulante</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($oferta->postulaciones as $postulacion)
                        <tr class="bg-gray-100">
                            <td class="border px-4 py-2">{{ $postulacion->user->name }}</td>
                            <td class="border px-4 py-2">{{ $postulacion->user->email }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($postulacion->estado) }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('postulaciones.cambiarEstado', $postulacion->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="estado" class="form-select" onchange="this.form.submit()">
                                        <option value="pendiente" {{ $postulacion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="aceptado" {{ $postulacion->estado == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
                                        <option value="rechazado" {{ $postulacion->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
