<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Hash;

class FarmavidaSeeder extends Seeder
{
    public function run(): void
    {
        
        // 1. CREAR USUARIOS DE PRUEBA CON SUS ROLES
        User::create([
            'name' => 'Administrador Donato',
            'email' => 'admin@farmavida.com',
            'password' => Hash::make('password123'),
            'rol' => 'administrador',
        ]);

        User::create([
            'name' => 'Químico Farmacéutico Pérez',
            'email' => 'quimico@farmavida.com',
            'password' => Hash::make('password123'),
            'rol' => 'quimico',
        ]);

        User::create([
            'name' => 'Cajero Alejandro',
            'email' => 'cajero@farmavida.com',
            'password' => Hash::make('password123'),
            'rol' => 'cajero',
        ]);

        // 2. CREAR MEDICAMENTOS INICIALES
        Medicamento::create([
            'codigo' => 'MED001',
            'nombre' => 'Paracetamol 500mg',
            'principio_activo' => 'Acetaminofén',
            'precio' => 1.50,
            'stock' => 100,
            'requiere_receta' => false, // Venta libre
        ]);

        Medicamento::create([
            'codigo' => 'MED002',
            'nombre' => 'Amoxicilina 500mg',
            'principio_activo' => 'Amoxicilina trihidrato',
            'precio' => 3.20,
            'stock' => 50,
            'requiere_receta' => true, // Requiere control del Químico
        ]);

        Medicamento::create([
            'codigo' => 'MED003',
            'nombre' => 'Ibuprofeno 400mg',
            'principio_activo' => 'Ibuprofeno',
            'precio' => 2.00,
            'stock' => 120,
            'requiere_receta' => false,
        ]);
    }
}
