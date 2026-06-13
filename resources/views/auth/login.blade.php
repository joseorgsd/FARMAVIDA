<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARMAVIDA — Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { farmavida: { primary: '#0f4c75', dark: '#0a3152', accent: '#16a085' } } } }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-farmavida-dark via-farmavida-primary to-teal-600 flex items-center justify-center p-4">

<div class="w-full max-w-4xl flex rounded-2xl overflow-hidden shadow-2xl">

    {{-- Panel izquierdo informativo --}}
    <div class="hidden md:flex flex-col justify-between w-1/2 bg-farmavida-dark p-10 text-white">
        <div>
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-farmavida-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold">FARMAVIDA</h1>
                    <p class="text-blue-300 text-xs">Sistema de Gestión Farmacéutica</p>
                </div>
            </div>

            <h2 class="text-2xl font-bold mb-3 leading-tight">Confianza · Salud · Tecnología</h2>
            <p class="text-blue-200 text-sm leading-relaxed mb-8">
                Plataforma integral para la gestión segura de farmacias. Control de inventario, ventas, recetas controladas y facturación electrónica.
            </p>

            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-teal-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Control de inventario en tiempo real</p>
                        <p class="text-blue-300 text-xs">Stock actualizado con cada transacción</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-teal-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Validación de recetas controladas</p>
                        <p class="text-blue-300 text-xs">Autorización del Químico Farmacéutico</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-teal-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Acceso diferenciado por rol</p>
                        <p class="text-blue-300 text-xs">Administrador, Químico y Cajero</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 pt-6">
            <p class="text-blue-300 text-xs">© 2026 FARMAVIDA — Grupo 3 · Desarrollo de Aplicaciones en Internet · Tecsup</p>
        </div>
    </div>

    {{-- Panel derecho: formulario --}}
    <div class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Iniciar sesión</h2>
            <p class="text-gray-500 text-sm">Ingresa tus credenciales para acceder al sistema</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-red-700 mb-5">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="usuario@farmavida.com">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-farmavida-primary hover:bg-farmavida-dark text-white font-semibold py-2.5 rounded-lg transition-colors text-sm mt-2">
                Ingresar al sistema
            </button>
        </form>

        {{-- Credenciales de prueba --}}
        <div class="mt-8 border-t border-gray-100 pt-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Cuentas de prueba</p>
            <div class="space-y-2 text-xs text-gray-600">
                <div class="flex items-center justify-between bg-purple-50 rounded-lg px-3 py-2">
                    <div><span class="font-semibold text-purple-700">Administrador</span><br>admin@farmavida.com</div>
                    <span class="text-gray-400">password123</span>
                </div>
                <div class="flex items-center justify-between bg-teal-50 rounded-lg px-3 py-2">
                    <div><span class="font-semibold text-teal-700">Químico</span><br>quimico@farmavida.com</div>
                    <span class="text-gray-400">password123</span>
                </div>
                <div class="flex items-center justify-between bg-blue-50 rounded-lg px-3 py-2">
                    <div><span class="font-semibold text-blue-700">Cajero</span><br>cajero@farmavida.com</div>
                    <span class="text-gray-400">password123</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
