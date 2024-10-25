<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500">
        <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
            
            <!-- Sección izquierda con el gradiente -->
            <div class="w-1/2 bg-gradient-to-r from-purple-600 to-blue-600 p-8 text-center flex flex-col justify-center">
                <h2 class="text-4xl font-extrabold text-white mb-4">¡Bienvenido!</h2>
                <p class="text-white text-lg">Crea tu cuenta para acceder</p>
                <div class="mt-8">
                    <x-authentication-card-logo class="w-24 h-24 mx-auto" />
                </div>
                <p class="text-white mt-4">www.upeu.com</p>
            </div>

            <!-- Sección derecha del formulario de registro -->
            <div class="w-1/2 p-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center">Registro</h2>

                <!-- Errores de validación -->
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Campo de Nombre -->
                    <div class="mb-4">
                        <x-label for="name" value="Nombre" class="font-bold text-gray-700" />
                        <x-input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Campo para DNI -->
                    <div class="mb-4">
                        <x-label for="dni" value="DNI" class="font-bold text-gray-700" />
                        <x-input id="dni" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="text" name="dni" :value="old('dni')" />
                    </div>

                    <!-- Campo para RUC -->
                    <div class="mb-4">
                        <x-label for="ruc" value="RUC" class="font-bold text-gray-700" />
                        <x-input id="ruc" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="text" name="ruc" :value="old('ruc')" />
                    </div>

                    <!-- Campo de Email -->
                    <div class="mb-4">
                        <x-label for="email" value="Correo Electrónico" class="font-bold text-gray-700" />
                        <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Campo de Correo Alternativo -->
                    <div class="mb-4">
                        <x-label for="correo" value="Correo Alternativo" class="font-bold text-gray-700" />
                        <x-input id="correo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="email" name="correo" :value="old('correo')" />
                    </div>

                    <!-- Campo de Celular -->
                    <div class="mb-4">
                        <x-label for="celular" value="Celular" class="font-bold text-gray-700" />
                        <x-input id="celular" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="text" name="celular" :value="old('celular')" />
                    </div>

                    <!-- Selección de Rol -->
                    <div class="mb-4">
                        <x-label for="rol" value="Rol" class="font-bold text-gray-700" />
                        <select id="rol" name="rol" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" onchange="toggleCvUploadField()">
                            <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="empresa" {{ old('rol') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                            <option value="postulante" {{ old('rol') == 'postulante' ? 'selected' : '' }}>Postulante</option>
                            <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        </select>
                    </div>

                    <!-- Campo de Contraseña -->
                    <div class="mb-4">
                        <x-label for="password" value="Contraseña" class="font-bold text-gray-700" />
                        <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="password" name="password" required />
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-4">
                        <x-label for="password_confirmation" value="Confirmar Contraseña" class="font-bold text-gray-700" />
                        <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="password" name="password_confirmation" required />
                    </div>

                    <!-- Cargar CV (solo para postulantes) -->
                    <div class="mb-4" id="cv-upload" style="display: none;">
                        <x-label for="archivo_cv" value="Cargar CV (solo para postulantes)" class="font-bold text-gray-700" />
                        <x-input id="archivo_cv" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="file" name="archivo_cv" />
                    </div>

                    <!-- Términos y Condiciones (opcional si se activa esta característica) -->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mb-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
                                    <div class="ml-2">
                                        {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Términos de Servicio').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Política de Privacidad').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            ¿Ya tienes cuenta? Inicia sesión
                        </a>

                        <x-button class="ml-4 bg-gradient-to-r from-purple-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md hover:from-purple-600 hover:to-blue-600">
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
