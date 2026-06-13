<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Medicamento;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::orderBy('nombre')->get();
        $clientes = Cliente::orderBy('nombre_completo')->get();

        return view(
            'ventas.index',
            compact('medicamentos','clientes')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'=>'required',
            'medicamento_id'=>'required',
            'cantidad'=>'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {

            $medicamento = Medicamento::findOrFail(
                $request->medicamento_id
            );

            if($request->cantidad > $medicamento->stock)
            {
                return back()
                    ->with('error',
                    'Stock insuficiente');
            }

            $total =
                $medicamento->precio *
                $request->cantidad;

            $venta = Venta::create([
                'cliente_id'=>$request->cliente_id,
                'total'=>$total
            ]);

            DetalleVenta::create([
                'venta_id'=>$venta->id,
                'medicamento_id'=>$medicamento->id,
                'cantidad'=>$request->cantidad,
                'precio'=>$medicamento->precio
            ]);

            $medicamento->stock -=
                $request->cantidad;

            $medicamento->save();

            DB::commit();

            return back()
                ->with('success',
                'Venta registrada');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error',
                $e->getMessage());
        }
    }
}