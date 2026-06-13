<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::orderBy('nombre_completo')->get();
        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        return view('medicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'colegiatura_cmp' => 'required|string|max:20|unique:medicos,colegiatura_cmp',
            'nombre_completo' => 'required|string|max:200',
        ], [
            'colegiatura_cmp.unique' => 'Ya existe un médico registrado con ese número de colegiatura.',
        ]);

        Medico::create($request->only(['colegiatura_cmp', 'nombre_completo']));

        return redirect()->route('medicos.index')->with('success', 'Médico registrado correctamente.');
    }

    public function show(Medico $medico)
    {
        return redirect()->route('medicos.index');
    }

    public function edit(Medico $medico)
    {
        return view('medicos.edit', compact('medico'));
    }

    public function update(Request $request, Medico $medico)
    {
        $request->validate([
            'colegiatura_cmp' => 'required|string|max:20|unique:medicos,colegiatura_cmp,' . $medico->id,
            'nombre_completo' => 'required|string|max:200',
        ], [
            'colegiatura_cmp.unique' => 'Ya existe un médico registrado con ese número de colegiatura.',
        ]);

        $medico->update($request->only(['colegiatura_cmp', 'nombre_completo']));

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado correctamente.');
    }

    public function destroy(Medico $medico)
    {
        $medico->delete();
        return redirect()->route('medicos.index')->with('success', 'Médico eliminado correctamente.');
    }
}
