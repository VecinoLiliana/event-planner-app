<!-- Authentication Card, para autenticación de usuarios -->
<div class="min-h-screen flex flex-col sm:justify-center items-center p-8 bg-white">
    <div class="mb-8">
        {{ $logo }}
    </div>
    <!-- Contenedor de la tarjeta de autenticación -->
    <div class="w-full sm:max-w-md px-10 md:px-12 py-8 bg-white shadow-lg overflow-hidden rounded-2xl border border-gray-200">
        {{ $slot }}
    </div>
</div>
