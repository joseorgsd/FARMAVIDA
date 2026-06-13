@extends('layouts.app')
@section('title', 'Editar Medicamento')
@section('page-title', 'Editar Medicamento')

@section('content')
<div class="max-w-2xl">
    <div class="card p-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
            <a href="{{ route('medicamentos.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-base font-bold text-gray-800">Editar: {{ $medicamento->nombre }}</h2>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-5 text-sm text-red-700 space-y-1">
            @foreach($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Código <span class="text-red-500">*</span></label>
                    <input type="text" name="codigo" value="{{ old('codigo', $medicamento->codigo) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Precio (S/) <span class="text-red-500">*</span></label>
                    <input type="number" name="precio" value="{{ old('precio', $medicamento->precio) }}" class="form-input" step="0.01" min="0" required>
                </div>
            </div>

            <div>
                <label class="form-label">Nombre del Medicamento <span class="text-red-500">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre', $medicamento->nombre) }}" class="form-input" required>
            </div>

            <div>
                <label class="form-label">Principio Activo <span class="text-red-500">*</span></label>
                <input type="text" name="principio_activo" value="{{ old('principio_activo', $medicamento->principio_activo) }}" class="form-input" required>
            </div>

            <div>
                <label class="form-label">Stock <span class="text-red-500">*</span></label>
                <input type="number" name="stock" value="{{ old('stock', $medicamento->stock) }}" class="form-input" min="0" required>
            </div>

            <div class="flex items-center gap-3 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                <input type="checkbox" name="requiere_receta" id="requiere_receta" value="1"
                    {{ old('requiere_receta', $medicamento->requiere_receta) ? 'checked' : '' }}
                    class="w-4 h-4 text-amber-500 border-gray-300 rounded focus:ring-amber-400">
                <div>
                    <label for="requiere_receta" class="text-sm font-semibold text-amber-800 cursor-pointer">Requiere receta médica</label>
                    <p class="text-xs text-amber-600">Marcarlo bloqueará la dispensación sin autorización del Químico Farmacéutico.</p>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Guardar Cambios</button>
                <a href="{{ route('medicamentos.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
