<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARMAVIDA — @yield('title', 'Sistema de Gestión')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        farmavida: {
                            primary: '#0f4c75',
                            secondary: '#1b6ca8',
                            accent: '#16a085',
                            light: '#eaf4fb',
                            dark: '#0a3152',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/10 transition-all; }
        .sidebar-link.active { @apply bg-white/20 text-white; }
        .btn-primary { @apply bg-farmavida-primary hover:bg-farmavida-dark text-white font-semibold px-4 py-2 rounded-lg transition-colors text-sm; }
        .btn-secondary { @apply bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-lg transition-colors text-sm; }
        .btn-danger { @apply bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1.5 rounded-lg transition-colors text-sm; }
        .btn-edit { @apply bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1.5 rounded-lg transition-colors text-sm; }
        .form-input { @apply w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-farmavida-secondary focus:border-transparent; }
        .form-label { @apply block text-sm font-medium text-gray-700 mb-1; }
        .card { @apply bg-white rounded-xl shadow-sm border border-gray-100; }
        .badge-admin { @apply bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-0.5 rounded-full; }
        .badge-quimico { @apply bg-teal-100 text-teal-800 text-xs font-semibold px-2 py-0.5 rounded-full; }
        .badge-cajero { @apply bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-full; }
    </style>
</head>
<body class="bg-gray-50 font-sans">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 flex-shrink-0 bg-gradient-to-b from-farmavida-dark to-farmavida-primary flex flex-col shadow-xl">

        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-white rounded-lg flex items-center justify-center shadow">
                    <svg class="w-5 h-5 text-farmavida-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-base leading-tight">FARMAVIDA</p>
                    <p class="text-blue-200 text-xs">Gestión Farmacéutica</p>
                </div>
            </div>
        </div>

        {{-- Usuario actual --}}
        <div class="px-4 py-3 border-b border-white/10">
            <p class="text-blue-200 text-xs uppercase tracking-wider mb-1">Usuario</p>
            <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
            @php $rol = auth()->user()->rol; @endphp
            <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full font-medium
                {{ $rol === 'administrador' ? 'bg-purple-400/30 text-purple-200' : ($rol === 'quimico' ? 'bg-teal-400/30 text-teal-200' : 'bg-blue-400/30 text-blue-200') }}">
                {{ ucfirst($rol) }}
            </span>
        </div>

        {{-- Navegación --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <p class="text-blue-300 text-xs uppercase tracking-wider px-3 mb-2">General</p>

            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                Dashboard
            </a>

            <a href="{{ route('ventas.index') }}" class="sidebar-link {{ request()->routeIs('ventas.*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Registrar Venta
            </a>

            <a href="{{ route('recetas.index') }}" class="sidebar-link {{ request()->routeIs('recetas.*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Validar Prescripción
            </a>

            @if(auth()->user()->rol === 'administrador')
            <div class="pt-3">
                <p class="text-blue-300 text-xs uppercase tracking-wider px-3 mb-2">Administración</p>

                <a href="{{ route('medicamentos.index') }}" class="sidebar-link {{ request()->routeIs('medicamentos.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Medicamentos
                </a>

                <a href="{{ route('clientes.index') }}" class="sidebar-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Clientes
                </a>

                <a href="{{ route('medicos.index') }}" class="sidebar-link {{ request()->routeIs('medicos.*') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Médicos
                </a>
            </div>
            @endif
        </nav>

        {{-- Cerrar sesión --}}
        <div class="px-4 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 text-sm text-blue-200 hover:text-white transition-colors px-3 py-2 rounded-lg hover:bg-white/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shadow-sm flex-shrink-0">
            <h1 class="text-lg font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">{{ now()->format('d/m/Y H:i') }}</span>
            </div>
        </header>

        {{-- Alerts --}}
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Contenido --}}
        <div class="flex-1 overflow-y-auto px-6 py-4">
            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
