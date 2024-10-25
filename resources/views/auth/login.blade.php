<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500">
        <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
            
            <!-- Sección izquierda con el gradiente -->
            <div class="w-1/2 bg-gradient-to-r from-purple-600 to-blue-600 p-8 text-center flex flex-col justify-center">
                <h2 class="text-4xl font-extrabold text-white mb-4">¡Bienvenido!</h2>
                <p class="text-white text-lg">Estamos contigo</p>
                <div class="mt-8">
                    <x-authentication-card-logo class="w-24 h-24 mx-auto" />
                </div>
                <p class="text-white mt-4">www.upeu.com</p>
            </div>

            <!-- Sección derecha del formulario de inicio de sesión -->
            <div class="w-1/2 p-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center">Acceso</h2>
                
                <!-- Errores de validación -->
                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Campo de Email -->
                    <div class="mb-4">
                        <x-label for="email" value="Correo Electrónico" class="font-bold text-gray-700" />
                        <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Campo de Password -->
                    <div class="mb-4">
                        <x-label for="password" value="Contraseña" class="font-bold text-gray-700" />
                        <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" type="password" name="password" required />
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center mb-4">
                        <x-checkbox id="remember_me" name="remember" class="text-indigo-600" />
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">Recuérdame</label>
                    </div>

                    <!-- Enlace de contraseña olvidada y botón de Login -->
                    <div class="flex items-center justify-between mb-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif

                        <x-button class="ml-4 bg-gradient-to-r from-purple-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md hover:from-purple-600 hover:to-blue-600">
                            Iniciar sesión
                        </x-button>
                    </div>

                    <!-- Opción de login alternativo (social media) -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-500 mb-4">Te quiero mucho usuario</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-blue-500"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-red-500"><i class="fab fa-google fa-2x"></i></a>
                            <a href="#" class="text-blue-400"><i class="fab fa-twitter fa-2x"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
