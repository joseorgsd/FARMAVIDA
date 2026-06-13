@extends('layouts.app')
@section('title', 'Médicos')
@section('page-title', 'Gestión de Médicos')

@section('content')
<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">{{ $medicos->count() }}</span> médicos registrados</p>
        <a href="{{ route('medicos.create') }}" class="btn-primary inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuevo Médico
        </a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">N° Colegiatura (CMP)</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($medicos as $medico)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3.5 font-mono font-semibold text-purple-700">{{ $medico->colegiatura_cmp }}</td>
                        <td class="px-5 py-3.5 font-medium text-gray-800">{{ $medico->nombre_completo }}</td>
                        <td class="px-5 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('medicos.edit', $medico->id) }}" class="btn-edit">Editar</a>
                                <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este médico?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-5 py-10 text-center text-gray-400 text-sm">
                            No hay médicos registrados aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
