<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    // 1. Listar los medicamentos
    public function index()
    {
        $medicamentos = Medicamento::all();
        return view('medicamentos.index', compact('medicamentos'));
    }

    // 2. Mostrar el formulario de creación
    public function create()
    {
        return view('medicamentos.create');
    }

    // 3. Guardar el nuevo medicamento en la BD
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:medicamentos,codigo',
            'nombre' => 'required',
            'principio_activo' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Manejar el checkbox de requiere receta
        $datos = $request->all();
        $datos['requiere_receta'] = $request->has('requiere_receta');

        Medicamento::create($datos);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento registrado con éxito.');
    }

    // 4. Mostrar el formulario de edición
    public function edit($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamentos.edit', compact('medicamento'));
    }

    // 5. Actualizar los datos en la BD
    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);

        $request->validate([
            'codigo' => 'required|unique:medicamentos,codigo,' . $id,
            'nombre' => 'required',
            'principio_activo' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $datos = $request->all();
        $datos['requiere_receta'] = $request->has('requiere_receta');

        $medicamento->update($datos);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado con éxito.');
    }

    // 6. Eliminar un medicamento
    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }
}
