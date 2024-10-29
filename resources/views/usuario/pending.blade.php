<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-gradient-to-r from-cyan-500 to-blue-600 py-6">
            {{ __('Usuarios Pendientes de Aprobación') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-6 lg:p-8">
                <!-- Lista de usuarios pendientes en formato de lista -->
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
                        <thead class="bg-cyan-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Correo Electrónico</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Rol</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold uppercase">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <!-- Nombre del usuario -->
                                <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                    <img src="https://i.pravatar.cc/50?u={{ $user->id }}" alt="Avatar" class="w-10 h-10 rounded-full mr-3 border-2 border-cyan-300 shadow">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </td>

                                <!-- Correo Electrónico -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </td>

                                <!-- Rol del usuario -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-cyan-700">{{ ucfirst($user->rol) }}</div>
                                </td>

                                <!-- Botón para aprobar -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('usuarios.approve', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition-transform duration-300 ease-in-out hover:scale-105">
                                            Aprobar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Enlaces de paginación -->
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
