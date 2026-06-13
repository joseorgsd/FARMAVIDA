@extends('layouts.app')
@section('title', 'Validar Prescripción')
@section('page-title', 'Proceso Secundario: Validar Prescripción Controlada')

@section('content')
<div class="space-y-5">

    {{-- Alerta de rol --}}
    @if(auth()->user()->rol === 'cajero')
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>
            <p class="text-sm font-semibold text-amber-800">Solo visualización</p>
            <p class="text-xs text-amber-700 mt-0.5">Como cajero puedes ver el estado de las prescripciones, pero la aprobación o rechazo es exclusiva del Químico Farmacéutico.</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        {{-- Formulario de nueva prescripción --}}
        @if(auth()->user()->rol !== 'cajero')
        <div class="card p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Registrar Prescripción
            </h3>

            <form id="formReceta" class="space-y-4" onsubmit="registrarReceta(event)">
                <div>
                    <label class="form-label">Paciente (Cliente) <span class="text-red-500">*</span></label>
                    <select id="recetaCliente" class="form-input" required>
                        <option value="">— Seleccionar cliente —</option>
                        @foreach($clientes as $c)
                            <option value="{{ $c->id }}" data-nombre="{{ $c->nombre_completo }}">{{ $c->dni }} — {{ $c->nombre_completo }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Médico Prescriptor <span class="text-red-500">*</span></label>
                    <select id="recetaMedico" class="form-input" required>
                        <option value="">— Seleccionar médico —</option>
                        @foreach($medicos as $m)
                            <option value="{{ $m->id }}" data-nombre="{{ $m->nombre_completo }}" data-cmp="{{ $m->colegiatura_cmp }}">{{ $m->colegiatura_cmp }} — {{ $m->nombre_completo }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Medicamento Controlado <span class="text-red-500">*</span></label>
                    <select id="recetaMedicamento" class="form-input" required>
                        <option value="">— Seleccionar medicamento —</option>
                        @foreach($medicamentosControlados as $med)
                            <option value="{{ $med->id }}" data-nombre="{{ $med->nombre }}">{{ $med->codigo }} — {{ $med->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Cantidad prescrita <span class="text-red-500">*</span></label>
                    <input type="number" id="recetaCantidad" class="form-input" min="1" value="1" required>
                </div>

                <div>
                    <label class="form-label">Observaciones del Químico</label>
                    <textarea id="recetaObservaciones" class="form-input resize-none" rows="2" placeholder="Indicaciones adicionales..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-1">
                    <button type="button" onclick="resolverReceta('aprobada')"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                        ✓ Aprobar dispensación
                    </button>
                    <button type="button" onclick="resolverReceta('rechazada')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                        ✗ Rechazar dispensación
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="card p-6 flex items-center justify-center text-center">
            <div>
                <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <p class="font-semibold text-gray-700 text-sm">Acceso restringido</p>
                <p class="text-xs text-gray-400 mt-1">La aprobación de recetas es exclusiva del Químico Farmacéutico o Administrador.</p>
            </div>
        </div>
        @endif

        {{-- Historial de prescripciones (simulado) --}}
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-sm">Prescripciones del día</h3>
                <span class="text-xs text-gray-400" id="contadorRecetas">0 registradas</span>
            </div>
            <div id="listaRecetas" class="divide-y divide-gray-50 max-h-96 overflow-y-auto">
                <p class="text-sm text-gray-400 text-center py-8" id="sinRecetas">No hay prescripciones registradas hoy.</p>
            </div>
        </div>
    </div>

</div>

<script>
let recetas = [];

function resolverReceta(decision) {
    const clienteEl = document.getElementById('recetaCliente');
    const medicoEl = document.getElementById('recetaMedico');
    const medEl = document.getElementById('recetaMedicamento');
    const cantidad = document.getElementById('recetaCantidad').value;
    const obs = document.getElementById('recetaObservaciones').value;

    if (!clienteEl.value || !medicoEl.value || !medEl.value || !cantidad) {
        alert('Por favor, completa todos los campos requeridos.');
        return;
    }

    const paciente = clienteEl.options[clienteEl.selectedIndex].dataset.nombre;
    const medico = medicoEl.options[medicoEl.selectedIndex].dataset.nombre;
    const cmp = medicoEl.options[medicoEl.selectedIndex].dataset.cmp;
    const medicamento = medEl.options[medEl.selectedIndex].dataset.nombre;

    const receta = {
        id: Date.now(),
        paciente, medico, cmp, medicamento, cantidad, obs,
        decision,
        hora: new Date().toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit' })
    };

    recetas.unshift(receta);
    renderRecetas();
    document.getElementById('formReceta').reset();
}

function renderRecetas() {
    const lista = document.getElementById('listaRecetas');
    document.getElementById('contadorRecetas').textContent = recetas.length + ' registradas';

    if (recetas.length === 0) {
        lista.innerHTML = '<p class="text-sm text-gray-400 text-center py-8">No hay prescripciones registradas hoy.</p>';
        return;
    }

    lista.innerHTML = recetas.map(r => `
        <div class="px-5 py-4">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-semibold text-gray-500">${r.hora}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full font-semibold ${r.decision === 'aprobada' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">
                            ${r.decision === 'aprobada' ? '✓ Aprobada' : '✗ Rechazada'}
                        </span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800">${r.medicamento} × ${r.cantidad}</p>
                    <p class="text-xs text-gray-500">Paciente: ${r.paciente}</p>
                    <p class="text-xs text-gray-500">Dr. ${r.medico} · CMP ${r.cmp}</p>
                    ${r.obs ? `<p class="text-xs text-gray-400 italic mt-1">"${r.obs}"</p>` : ''}
                </div>
            </div>
        </div>
    `).join('');
}
</script>
@endsection
