@extends('layouts.app')
@section('title', 'Medicamentos')
@section('page-title', 'Gestión de Medicamentos')

@section('content')
<div class="space-y-4">

    {{-- Header con botón --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">{{ $medicamentos->count() }}</span> medicamentos registrados</p>
        <a href="{{ route('medicamentos.create') }}" class="btn-primary inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuevo Medicamento
        </a>
    </div>

    {{-- Tabla --}}
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Principio Activo</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Receta</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($medicamentos as $med)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3.5 font-mono text-xs text-gray-500">{{ $med->codigo }}</td>
                        <td class="px-5 py-3.5 font-semibold text-gray-800">{{ $med->nombre }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $med->principio_activo }}</td>
                        <td class="px-5 py-3.5 text-gray-700 font-medium">S/ {{ number_format($med->precio, 2) }}</td>
                        <td class="px-5 py-3.5">
                            <span class="font-semibold {{ $med->stock <= 10 ? 'text-red-600' : ($med->stock <= 30 ? 'text-yellow-600' : 'text-green-600') }}">
                                {{ $med->stock }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($med->requiere_receta)
                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Controlado</span>
                            @else
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Venta libre</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('medicamentos.edit', $med->id) }}" class="btn-edit">Editar</a>
                                <form action="{{ route('medicamentos.destroy', $med->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este medicamento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-10 text-center text-gray-400 text-sm">
                            No hay medicamentos registrados aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
