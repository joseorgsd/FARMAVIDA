@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Boleta de Venta</h3>
        </div>

        <div class="card-body">

            <p>
                <strong>N° Venta:</strong>
                {{ $venta->id }}
            </p>

            <p>
                <strong>Cliente:</strong>
                {{ $venta->cliente->nombre_completo }}
            </p>

            <p>
                <strong>Fecha:</strong>
                {{ $venta->created_at }}
            </p>

            <table class="table">

                <thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($venta->detalles as $detalle)

                    <tr>
                        <td>
                            {{ $detalle->medicamento->nombre }}
                        </td>

                        <td>
                            {{ $detalle->cantidad }}
                        </td>

                        <td>
                            S/. {{ number_format($detalle->precio,2) }}
                        </td>

                        <td>
                            S/. {{ number_format($detalle->cantidad * $detalle->precio,2) }}
                        </td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

            <h4 class="text-end">
                Total:
                S/. {{ number_format($venta->total,2) }}
            </h4>

            <button
                onclick="window.print()"
                class="btn btn-primary">
                Imprimir
            </button>

            <a href="{{ route('ventas.index') }}"
               class="btn btn-secondary">
                Nueva Venta
            </a>

        </div>

    </div>

</div>

@endsection