<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-gradient-to-br from-cyan-500 to-blue-600 py-6">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Formulario de búsqueda compacto en la parte superior -->
            <div class="bg-gradient-to-r from-blue-300 to-cyan-500 p-4 rounded-lg shadow-md mb-6 flex items-center justify-between space-x-4">
                <!-- Campo de búsqueda -->
                <form action="{{ route('usuarios.index') }}" method="GET" class="flex items-center w-full space-x-2">
                    <input type="text" name="search" id="search" placeholder="Buscar usuarios..." class="flex-grow px-4 py-2 rounded-lg border-none shadow-md focus:ring-2 focus:ring-blue-400" value="{{ request()->get('search') }}">
                    
                    <!-- Filtro por Rol compacto -->
                    <select name="rol" id="rol" class="px-4 py-2 rounded-lg border-none shadow-md focus:ring-2 focus:ring-blue-400">
                        <option value="">Todos los Roles</option>
                        <option value="admin" {{ request()->get('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="empresa" {{ request()->get('rol') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                        <option value="postulante" {{ request()->get('rol') == 'postulante' ? 'selected' : '' }}>Postulante</option>
                        <option value="supervisor" {{ request()->get('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    </select>

                    <!-- Botón de Búsqueda -->
                    <button type="submit" class="bg-white hover:bg-blue-100 text-cyan-700 font-bold px-4 py-2 rounded-lg shadow-md transition duration-300">
                        Buscar
                    </button>
                </form>
            </div>

            <!-- Botones de acción flotantes a la derecha -->
            <div class="flex justify-end mb-4">
                <x-buttonusers href="{{ route('usuarios.create') }}" color="bg-cyan-600" hover="hover:bg-cyan-700" icon="fas fa-user-plus" class="shadow-lg px-5 py-3">
                    Añadir Usuario
                </x-buttonusers>
                
                <x-buttonusers href="{{ route('usuarios.pending') }}" color="bg-orange-500" hover="hover:bg-orange-600" icon="fas fa-users-cog" :counter="$pendingUsersCount" class="ml-4 shadow-lg px-5 py-3">
                    Pendientes
                </x-buttonusers>
            </div>

            <!-- Lista de usuarios rediseñada en formato de filas -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <li class="flex items-center justify-between py-4 hover:bg-gray-100 transition duration-200">
                        <div class="flex items-center space-x-4">
                            <!-- Foto de perfil en círculo -->
                            <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}" alt="Foto de {{ $user->name }}" class="w-12 h-12 rounded-full border-2 border-blue-500 shadow-sm">
                            
                            <!-- Información del usuario -->
                            <div>
                                <h3 class="text-lg font-bold text-gray-700">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                <p class="text-sm text-gray-400">{{ $user->rol }}</p>
                            </div>
                        </div>
                        
                        <!-- Botones de acción -->
                        <div class="flex space-x-3">
                            <!-- Ver más -->
                            <button class="text-blue-600 hover:text-blue-800" onclick="showModal({{ $user->id }})">
                                <i class="fas fa-eye"></i>
                            </button>
                            
                            <!-- Editar -->
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="delete-form inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Está seguro de que desea eliminar este usuario?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Enlaces de paginación -->
            <div class="mt-4">
                {{ $users->appends(['search' => request()->get('search')])->links() }}
            </div>
        </div>
    </div>

    <!-- Modal para mostrar más información -->
    <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-900">Detalles del Usuario</h3>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
            </div>
            <div class="mt-4">
                <p><strong>Nombre:</strong> <span id="modalName"></span></p>
                <p><strong>DNI:</strong> <span id="modalDNI"></span></p>
                <p><strong>RUC:</strong> <span id="modalRUC"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Correo Alternativo:</strong> <span id="modalCorreo"></span></p>
                <p><strong>Celular:</strong> <span id="modalCelular"></span></p>
                <p><strong>Rol:</strong> <span id="modalRol"></span></p>
                <p><strong>Archivo CV:</strong> <a href="#" id="modalCV" target="_blank" class="text-blue-500">Ver CV</a></p>
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cerrar</button>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const users = @json($users);

    function showModal(userId) {
        const user = users.data.find(u => u.id === userId);
        if (user) {
            document.getElementById('modalName').innerText = user.name;
            document.getElementById('modalDNI').innerText = user.dni || 'N/A';
            document.getElementById('modalRUC').innerText = user.ruc || 'N/A';
            document.getElementById('modalEmail').innerText = user.email;
            document.getElementById('modalCorreo').innerText = user.correo || 'N/A';
            document.getElementById('modalCelular').innerText = user.celular || 'N/A';
            document.getElementById('modalRol').innerText = user.rol;
            document.getElementById('modalCV').href = user.archivo_cv ? "{{ asset('storage/') }}" + '/' + user.archivo_cv : '#';
            document.getElementById('modalCV').innerText = user.archivo_cv ? 'Ver CV' : 'No disponible';

            document.getElementById('userModal').classList.remove('hidden');
            document.getElementById('userModal').classList.add('flex');
        }
    }

    function closeModal() {
        document.getElementById('userModal').classList.add('hidden');
        document.getElementById('userModal').classList.remove('flex');
    }
</script>
