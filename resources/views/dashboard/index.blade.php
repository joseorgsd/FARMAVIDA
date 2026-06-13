@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Bienvenida --}}
    <div class="bg-gradient-to-r from-farmavida-primary to-farmavida-secondary rounded-xl p-6 text-white">
        <h2 class="text-xl font-bold mb-1">Bienvenido, {{ auth()->user()->name }}</h2>
        <p class="text-blue-200 text-sm">
            @if(auth()->user()->rol === 'administrador')
                Tienes acceso completo al sistema. Gestiona medicamentos, clientes, médicos y procesos de venta.
            @elseif(auth()->user()->rol === 'quimico')
                Puedes validar prescripciones controladas y procesar ventas. Los módulos de administración están restringidos a tu perfil.
            @else
                Puedes registrar ventas y gestionar recetas. Accede a las funciones disponibles en el menú lateral.
            @endif
        </p>
    </div>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500 font-medium">Medicamentos</p>
                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalMedicamentos }}</p>
            <p class="text-xs text-gray-400 mt-1">Registrados en sistema</p>
        </div>

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500 font-medium">Clientes</p>
                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalClientes }}</p>
            <p class="text-xs text-gray-400 mt-1">Clientes registrados</p>
        </div>

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500 font-medium">Médicos</p>
                <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalMedicos }}</p>
            <p class="text-xs text-gray-400 mt-1">Médicos registrados</p>
        </div>

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500 font-medium">Requieren Receta</p>
                <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalControlados }}</p>
            <p class="text-xs text-gray-400 mt-1">Medicamentos controlados</p>
        </div>
    </div>

    {{-- Accesos rápidos --}}
    <div class="card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">Accesos Rápidos</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

            <a href="{{ route('ventas.index') }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl hover:border-farmavida-primary hover:bg-blue-50 transition-all group">
                <div class="w-10 h-10 bg-blue-100 group-hover:bg-farmavida-primary rounded-lg flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Registrar Venta</p>
                    <p class="text-xs text-gray-500">Proceso principal</p>
                </div>
            </a>

            <a href="{{ route('recetas.index') }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl hover:border-teal-500 hover:bg-teal-50 transition-all group">
                <div class="w-10 h-10 bg-teal-100 group-hover:bg-teal-500 rounded-lg flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-teal-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Validar Prescripción</p>
                    <p class="text-xs text-gray-500">Proceso secundario</p>
                </div>
            </a>

            @if(auth()->user()->rol === 'administrador')
            <a href="{{ route('medicamentos.create') }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition-all group">
                <div class="w-10 h-10 bg-purple-100 group-hover:bg-purple-500 rounded-lg flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Nuevo Medicamento</p>
                    <p class="text-xs text-gray-500">Agregar al inventario</p>
                </div>
            </a>
            @endif
        </div>
    </div>

    {{-- Últimos medicamentos --}}
    <div class="card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">Medicamentos recientes</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b border-gray-100">
                        <th class="pb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="pb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="pb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="pb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="pb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Receta</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($medicamentosRecientes as $med)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 font-mono text-xs text-gray-500">{{ $med->codigo }}</td>
                        <td class="py-3 font-medium text-gray-800">{{ $med->nombre }}</td>
                        <td class="py-3">
                            <span class="font-semibold {{ $med->stock <= 10 ? 'text-red-600' : 'text-gray-700' }}">
                                {{ $med->stock }}
                            </span>
                        </td>
                        <td class="py-3 text-gray-700">S/ {{ number_format($med->precio, 2) }}</td>
                        <td class="py-3">
                            @if($med->requiere_receta)
                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded-full">Sí</span>
                            @else
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full">No</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
