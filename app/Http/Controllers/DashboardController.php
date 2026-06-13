<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Cliente;
use App\Models\Medico;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalMedicamentos'  => Medicamento::count(),
            'totalClientes'      => Cliente::count(),
            'totalMedicos'       => Medico::count(),
            'totalControlados'   => Medicamento::where('requiere_receta', true)->count(),
            'medicamentosRecientes' => Medicamento::latest()->take(8)->get(),
        ]);
    }
}
