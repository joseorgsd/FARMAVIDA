@extends('layouts.app')
@section('title', 'Nuevo Cliente')
@section('page-title', 'Registrar Cliente')

@section('content')
<div class="max-w-lg">
    <div class="card p-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
            <a href="{{ route('clientes.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-base font-bold text-gray-800">Nuevo Cliente</h2>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-5 text-sm text-red-700 space-y-1">
            @foreach($errors->all() as $error)<p>• {{ $error }}</p>@endforeach
        </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">DNI <span class="text-red-500">*</span></label>
                <input type="text" name="dni" value="{{ old('dni') }}" class="form-input" placeholder="12345678" maxlength="8" required>
                <p class="text-xs text-gray-400 mt-1">8 dígitos, sin puntos ni guiones</p>
            </div>

            <div>
                <label class="form-label">Nombre Completo <span class="text-red-500">*</span></label>
                <input type="text" name="nombre_completo" value="{{ old('nombre_completo') }}" class="form-input" placeholder="Apellidos y nombres" required>
            </div>

            <div>
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-input" placeholder="9XXXXXXXX (opcional)">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Registrar Cliente</button>
                <a href="{{ route('clientes.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
