@extends('layouts.app')
@section('title', 'Registrar Venta')
@section('page-title', 'Proceso Principal: Registrar Venta y Cobro')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Panel izquierdo: búsqueda y lista de medicamentos --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Búsqueda de medicamentos --}}
        <div class="card p-5">
            <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-farmavida-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Búsqueda de Medicamentos
            </h3>
            <input type="text" id="buscador" placeholder="Buscar por nombre, código o principio activo..."
                class="form-input" oninput="filtrarMedicamentos(this.value)">
        </div>

        {{-- Tabla de medicamentos disponibles --}}
        <div class="card overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="font-semibold text-gray-700 text-sm">Medicamentos en inventario</h3>
            </div>
            <div class="overflow-x-auto max-h-72 overflow-y-auto">
                <table class="w-full text-sm" id="tablaMedicamentos">
                    <thead class="bg-white border-b border-gray-100 sticky top-0">
                        <tr>
                            <th class="px-5 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Código</th>
                            <th class="px-5 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Nombre</th>
                            <th class="px-5 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Principio Activo</th>
                            <th class="px-5 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Precio</th>
                            <th class="px-5 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Stock</th>
                            <th class="px-5 py-2.5 text-center text-xs font-semibold text-gray-500 uppercase">Agregar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50" id="cuerpoTabla">
                        @foreach($medicamentos as $med)
                        <tr class="hover:bg-blue-50 transition-colors fila-medicamento"
                            data-nombre="{{ strtolower($med->nombre) }}"
                            data-codigo="{{ strtolower($med->codigo) }}"
                            data-principio="{{ strtolower($med->principio_activo) }}">
                            <td class="px-5 py-3 font-mono text-xs text-gray-500">{{ $med->codigo }}</td>
                            <td class="px-5 py-3 font-medium text-gray-800">
                                {{ $med->nombre }}
                                @if($med->requiere_receta)
                                    <span class="ml-1 bg-red-100 text-red-600 text-xs px-1.5 py-0.5 rounded-full">Receta</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-600 text-xs">{{ $med->principio_activo }}</td>
                            <td class="px-5 py-3 font-semibold text-gray-700">S/ {{ number_format($med->precio, 2) }}</td>
                            <td class="px-5 py-3">
                                <span class="{{ $med->stock <= 10 ? 'text-red-600 font-bold' : 'text-gray-600' }}">{{ $med->stock }}</span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                @if($med->stock > 0)
                                    @if($med->requiere_receta)
                                        <button onclick="agregarControlado({{ $med->id }}, '{{ $med->nombre }}', {{ $med->precio }}, {{ $med->stock }})"
                                            class="bg-amber-100 hover:bg-amber-200 text-amber-800 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                                            + Con receta
                                        </button>
                                    @else
                                        <button onclick="agregar({{ $med->id }}, '{{ $med->nombre }}', {{ $med->precio }}, {{ $med->stock }})"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                                            + Agregar
                                        </button>
                                    @endif
                                @else
                                    <span class="text-xs text-red-400 font-medium">Sin stock</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Panel derecho: carrito y cobro --}}
    <div class="space-y-4">

        {{-- Datos del cliente --}}
        <div class="card p-5">
            <h3 class="font-bold text-gray-800 mb-3 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Datos del Cliente
            </h3>
            <select id="selectCliente" class="form-input text-sm">
                <option value="">— Cliente no identificado —</option>
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}">{{ $c->dni }} — {{ $c->nombre_completo }}</option>
                @endforeach
            </select>
        </div>

        {{-- Carrito de compras --}}
        <div class="card p-5">
            <h3 class="font-bold text-gray-800 mb-3 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Carrito de Compras
            </h3>
            <div id="carrito" class="space-y-2 min-h-16 mb-3">
                <p class="text-sm text-gray-400 text-center py-4" id="carritoVacio">No hay productos agregados</p>
            </div>

            <div class="border-t border-gray-100 pt-3 space-y-1">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Subtotal:</span>
                    <span id="subtotal">S/ 0.00</span>
                </div>
                <div class="flex justify-between text-sm text-gray-600">
                    <span>IGV (18%):</span>
                    <span id="igv">S/ 0.00</span>
                </div>
                <div class="flex justify-between font-bold text-gray-800 text-base pt-1 border-t border-gray-100">
                    <span>TOTAL:</span>
                    <span id="total">S/ 0.00</span>
                </div>
            </div>
        </div>

        {{-- Método de pago y cobro --}}
        <div class="card p-5">
            <h3 class="font-bold text-gray-800 mb-3 text-sm">Método de Pago</h3>
            <div class="grid grid-cols-3 gap-2 mb-4">
                <button onclick="seleccionarPago('efectivo')" id="btn-efectivo"
                    class="pago-btn active py-2 text-xs font-semibold border-2 border-farmavida-primary bg-blue-50 text-farmavida-primary rounded-lg transition-all">
                    Efectivo
                </button>
                <button onclick="seleccionarPago('tarjeta')" id="btn-tarjeta"
                    class="pago-btn py-2 text-xs font-semibold border-2 border-gray-200 text-gray-500 rounded-lg transition-all hover:border-farmavida-primary">
                    Tarjeta
                </button>
                <button onclick="seleccionarPago('transferencia')" id="btn-transferencia"
                    class="pago-btn py-2 text-xs font-semibold border-2 border-gray-200 text-gray-500 rounded-lg transition-all hover:border-farmavida-primary">
                    Transf.
                </button>
            </div>

            <div id="montoEfectivo" class="mb-3">
                <label class="form-label text-xs">Monto recibido (S/)</label>
                <input type="number" id="montoRecibido" class="form-input text-sm" placeholder="0.00" step="0.01" min="0" oninput="calcularVuelto()">
                <div class="flex justify-between text-sm mt-2">
                    <span class="text-gray-500">Vuelto:</span>
                    <span id="vuelto" class="font-bold text-green-600">S/ 0.00</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <button onclick="procesarVenta('boleta')"
                    class="bg-farmavida-primary hover:bg-farmavida-dark text-white text-xs font-semibold py-2.5 rounded-lg transition-colors">
                    Emitir Boleta
                </button>
                <button onclick="procesarVenta('factura')"
                    class="bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold py-2.5 rounded-lg transition-colors">
                    Emitir Factura
                </button>
            </div>
            <button onclick="limpiarCarrito()"
                class="w-full mt-2 text-xs text-gray-400 hover:text-red-500 py-2 transition-colors">
                Limpiar carrito
            </button>
        </div>

    </div>
</div>

{{-- Modal de confirmación de venta --}}
<div id="modalVenta" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
        <div class="text-center mb-5">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800">¡Venta Procesada!</h3>
            <p class="text-gray-500 text-sm mt-1" id="modalSubtitulo"></p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4 mb-4 text-sm space-y-1" id="modalDetalle"></div>
        <p class="text-xs text-center text-gray-400 mb-4">Comprobante enviado al sistema de SUNAT ✓</p>
        <button onclick="cerrarModal()" class="w-full btn-primary py-2.5">Nueva Venta</button>
    </div>
</div>
<form id="formVenta"
      action="{{ route('ventas.store') }}"
      method="POST"
      style="display:none;">

    @csrf

    <input type="hidden"
           name="cliente_id"
           id="clienteInput">

    <input type="hidden"
           name="medicamento_id"
           id="medicamentoInput">

    <input type="hidden"
           name="cantidad"
           id="cantidadInput">
</form>
<script>
let carrito = [];
let metodoPago = 'efectivo';

function filtrarMedicamentos(valor) {
    const filas = document.querySelectorAll('.fila-medicamento');
    const v = valor.toLowerCase();
    filas.forEach(fila => {
        const match = fila.dataset.nombre.includes(v) || fila.dataset.codigo.includes(v) || fila.dataset.principio.includes(v);
        fila.style.display = match ? '' : 'none';
    });
}

function agregar(id, nombre, precio, stockMax) {
    const idx = carrito.findIndex(i => i.id === id);
    if (idx >= 0) {
        if (carrito[idx].cantidad < stockMax) carrito[idx].cantidad++;
        else alert('No hay más stock disponible.');
    } else {
        carrito.push({ id, nombre, precio, cantidad: 1, stockMax, controlado: false });
    }
    renderCarrito();
}

function agregarControlado(id, nombre, precio, stockMax) {
    if (!confirm(`"${nombre}" requiere validación de receta por el Químico Farmacéutico.\n\n¿Confirmas que la receta fue validada y autorizada?`)) return;
    agregar(id, nombre, precio, stockMax);
}

function renderCarrito() {
    const div = document.getElementById('carrito');
    const vacioMsg = document.getElementById('carritoVacio');
    if (carrito.length === 0) {
        div.innerHTML = '<p class="text-sm text-gray-400 text-center py-4" id="carritoVacio">No hay productos agregados</p>';
        actualizarTotales();
        return;
    }
    div.innerHTML = carrito.map((item, i) => `
        <div class="flex items-center justify-between gap-2 bg-gray-50 rounded-lg px-3 py-2">
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-gray-800 truncate">${item.nombre}</p>
                <p class="text-xs text-gray-500">S/ ${item.precio.toFixed(2)}</p>
            </div>
            <div class="flex items-center gap-1.5 flex-shrink-0">
                <button onclick="cambiarCantidad(${i}, -1)" class="w-6 h-6 bg-gray-200 hover:bg-red-100 text-gray-700 rounded font-bold text-sm leading-none">−</button>
                <span class="text-sm font-bold w-5 text-center">${item.cantidad}</span>
                <button onclick="cambiarCantidad(${i}, 1)" class="w-6 h-6 bg-gray-200 hover:bg-green-100 text-gray-700 rounded font-bold text-sm leading-none">+</button>
            </div>
            <span class="text-xs font-semibold text-gray-700 w-16 text-right">S/ ${(item.precio * item.cantidad).toFixed(2)}</span>
        </div>
    `).join('');
    actualizarTotales();
}

function cambiarCantidad(i, delta) {
    carrito[i].cantidad += delta;
    if (carrito[i].cantidad <= 0) carrito.splice(i, 1);
    else if (carrito[i].cantidad > carrito[i].stockMax) carrito[i].cantidad = carrito[i].stockMax;
    renderCarrito();
}

function actualizarTotales() {
    const subtotal = carrito.reduce((s, i) => s + i.precio * i.cantidad, 0);
    const igv = subtotal * 0.18;
    const total = subtotal + igv;
    document.getElementById('subtotal').textContent = 'S/ ' + subtotal.toFixed(2);
    document.getElementById('igv').textContent = 'S/ ' + igv.toFixed(2);
    document.getElementById('total').textContent = 'S/ ' + total.toFixed(2);
    calcularVuelto();
}

function calcularVuelto() {
    const totalEl = document.getElementById('total').textContent;
    const total = parseFloat(totalEl.replace('S/ ', '')) || 0;
    const recibido = parseFloat(document.getElementById('montoRecibido').value) || 0;
    const vuelto = recibido - total;
    const el = document.getElementById('vuelto');
    el.textContent = 'S/ ' + Math.max(0, vuelto).toFixed(2);
    el.className = vuelto >= 0 ? 'font-bold text-green-600' : 'font-bold text-red-500';
}

function seleccionarPago(tipo) {
    metodoPago = tipo;
    document.querySelectorAll('.pago-btn').forEach(b => {
        b.className = 'pago-btn py-2 text-xs font-semibold border-2 border-gray-200 text-gray-500 rounded-lg transition-all hover:border-farmavida-primary';
    });
    const btn = document.getElementById('btn-' + tipo);
    btn.className = 'pago-btn active py-2 text-xs font-semibold border-2 border-farmavida-primary bg-blue-50 text-farmavida-primary rounded-lg transition-all';
    document.getElementById('montoEfectivo').style.display = tipo === 'efectivo' ? 'block' : 'none';
}

function procesarVenta(tipo)
{
    if(carrito.length === 0)
    {
        alert('El carrito está vacío');
        return;
    }

    if(carrito.length > 1)
    {
        alert(
            'Por ahora solo puede vender un medicamento por vez.'
        );
        return;
    }

    const item = carrito[0];

    let cliente =
        document.getElementById(
            'selectCliente'
        ).value;

    if(cliente === '')
    {
        alert(
            'Seleccione un cliente'
        );
        return;
    }

    document.getElementById(
        'clienteInput'
    ).value = cliente;

    document.getElementById(
        'medicamentoInput'
    ).value = item.id;

    document.getElementById(
        'cantidadInput'
    ).value = item.cantidad;

    document.getElementById(
        'formVenta'
    ).submit();
}

function cerrarModal() {
    document.getElementById('modalVenta').classList.add('hidden');
    limpiarCarrito();
}

function limpiarCarrito() {
    carrito = [];
    renderCarrito();
    document.getElementById('montoRecibido').value = '';
    document.getElementById('selectCliente').value = '';
}
</script>
@endsection
