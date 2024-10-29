<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white">
        <div class="flex w-full max-w-5xl bg-white shadow-lg rounded-lg overflow-hidden">
            
            <!-- Sección izquierda con el gradiente -->
            <div class="w-1/2 bg-gradient-to-r from-blue-400 to-blue-600 p-8 text-center flex flex-col justify-center">
                <h2 class="text-4xl font-extrabold text-white mb-4">¡Bienvenido!</h2>
                <p class="text-white text-lg">Crea tu cuenta para acceder</p>
                <div class="mt-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Registro" class="w-24 h-24 mx-auto" />
                </div>
                <p class="text-white mt-4">www.upeu.com</p>
            </div>

            <!-- Sección derecha del formulario de registro -->
            <div class="w-2/3 p-10">
                <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Registro</h2>

                <!-- Errores de validación -->
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-2 gap-6">
                        <!-- Campo de Nombre -->
                        <div class="relative mb-4">
                            <x-label for="name" value="Nombre" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="name" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                        </div>

                        <!-- Campo para DNI -->
                        <div class="relative mb-4">
                            <x-label for="dni" value="DNI" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-id-card absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="dni" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="text" name="dni" :value="old('dni')" />
                            </div>
                        </div>

                        <!-- Campo para RUC -->
                        <div class="relative mb-4">
                            <x-label for="ruc" value="RUC" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-building absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="ruc" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="text" name="ruc" :value="old('ruc')" />
                            </div>
                        </div>

                        <!-- Campo de Email -->
                        <div class="relative mb-4">
                            <x-label for="email" value="Correo Electrónico" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="email" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="email" name="email" :value="old('email')" required />
                            </div>
                        </div>

                        <!-- Campo de Correo Alternativo -->
                        <div class="relative mb-4">
                            <x-label for="correo" value="Correo Alternativo" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-envelope-open-text absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="correo" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="email" name="correo" :value="old('correo')" />
                            </div>
                        </div>

                        <!-- Campo de Celular -->
                        <div class="relative mb-4">
                            <x-label for="celular" value="Celular" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-mobile-alt absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="celular" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="text" name="celular" :value="old('celular')" />
                            </div>
                        </div>

                        <!-- Selección de Rol -->
                        <div class="relative mb-4">
                            <x-label for="rol" value="Rol" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-user-tag absolute left-3 top-3 text-gray-500"></i>
                                <select id="rol" name="rol" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" onchange="toggleCvUploadField()">
                                    <!--<option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>--> <!-- Opción Comentada -->
                                    <option value="empresa" {{ old('rol') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                                    <option value="postulante" {{ old('rol') == 'postulante' ? 'selected' : '' }}>Postulante</option>
                                    <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                </select>
                            </div>
                        </div>

                        <!-- Campo de Contraseña -->
                        <div class="relative mb-4">
                            <x-label for="password" value="Contraseña" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="password" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="password" name="password" required />
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="relative mb-4">
                            <x-label for="password_confirmation" value="Confirmar Contraseña" class="font-bold text-gray-700" />
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-3 text-gray-500"></i>
                                <x-input id="password_confirmation" class="block mt-1 w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="password" name="password_confirmation" required />
                            </div>
                        </div>
                    </div>

                    <!-- Cargar CV (solo para postulantes) -->
                    <div class="mb-4" id="cv-upload" style="display: none;">
                        <x-label for="archivo_cv" value="Cargar CV (solo para postulantes)" class="font-bold text-gray-700" />
                        <x-input id="archivo_cv" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-sm" type="file" name="archivo_cv" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            ¿Ya tienes cuenta? Inicia sesión
                        </a>

                        <x-button class="ml-4 bg-gradient-to-r from-purple-500 to-blue-500 text-white font-bold py-2 px-6 rounded-md hover:from-purple-600 hover:to-blue-600">
                            Registrarse
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para mostrar/ocultar el campo de carga de CV -->
    <script>
        function toggleCvUploadField() {
            var rol = document.getElementById('rol').value;
            var cvUploadField = document.getElementById('cv-upload');
            if (rol === 'postulante') {
                cvUploadField.style.display = 'block';
            } else {
                cvUploadField.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleCvUploadField();
        });
    </script>
</x-guest-layout>
