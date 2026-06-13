<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Cliente;
use App\Models\Medico;

class RecetaController extends Controller
{
    public function index()
    {
        $clientes              = Cliente::orderBy('nombre_completo')->get();
        $medicos               = Medico::orderBy('nombre_completo')->get();
        $medicamentosControlados = Medicamento::where('requiere_receta', true)->orderBy('nombre')->get();

        return view('recetas.index', compact('clientes', 'medicos', 'medicamentosControlados'));
    }
}
