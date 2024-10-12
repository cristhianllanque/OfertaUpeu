<!-- resources/views/auth/waiting_for_approval.blade.php -->

<x-guest-layout>
    <!-- Sección principal con video de fondo -->
    <div class="relative min-h-screen flex items-center justify-center bg-gray-100">
        <!-- Video de fondo -->
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('videos/video2.mp4') }}" type="video/mp4">
        </video>

        <!-- Capa de superposición semitransparente para mejorar la legibilidad -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

        <!-- Contenido principal con el segundo video -->
        <div class="relative z-20 bg-white shadow-lg rounded-lg p-10 max-w-md mx-auto text-center flex flex-col space-y-6">
            <!-- Mensaje principal de espera -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Tu Cuenta Está en Revisión</h1>

            <p class="text-gray-600 text-lg mb-6">Gracias por registrarte. Un administrador está revisando tu cuenta y pronto recibirás una notificación por correo electrónico.</p>

            <!-- Barra de progreso simulada -->
            <div class="relative pt-1">
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                    <div class="animate__animated animate__slideInLeft shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 w-3/4"></div>
                </div>
                <p class="text-sm text-gray-500">Procesando... 75%</p>
            </div>

            <!-- Iconos animados de espera -->
            <div class="flex justify-center space-x-6 my-4">
                <i class="fas fa-hourglass-half fa-2x text-yellow-500 animate__animated animate__flash animate__infinite"></i>
                <i class="fas fa-envelope-open-text fa-2x text-green-500 animate__animated animate__pulse animate__infinite"></i>
                <i class="fas fa-user-check fa-2x text-blue-500 animate__animated animate__bounce animate__infinite"></i>
            </div>

            <!-- Botón para volver a la página principal y cerrar sesión -->
            <div class="mt-4">
                <!-- Formulario de cierre de sesión -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- Botón que ejecuta el cierre de sesión y redirige -->
                <button
                    class="px-6 py-3 text-white bg-blue-500 rounded-full shadow-md hover:bg-blue-600 hover:shadow-xl transition duration-300 ease-in-out"
                    onclick="logoutAndRedirect()">
                    Volver a la Página Principal
                </button>

                <!-- Mensaje adicional de agradecimiento -->
                <p class="mt-6 text-gray-500">Gracias por tu paciencia y confianza en nuestro sistema.</p>
            </div>

            <!-- Segundo video en un recuadro al costado derecho -->
          
        </div>
    </div>

    <!-- Scripts para animaciones -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css"></script>
    <script>
        function logoutAndRedirect() {
            // Enviar el formulario de cierre de sesión
            document.getElementById('logout-form').submit();

            // Retrasar la redirección a la página principal para que el cierre de sesión se ejecute primero
            setTimeout(function() {
                window.location.href = '/';
            }, 1000); // Espera 1 segundo antes de redirigir
        }
    </script>
</x-guest-layout>
