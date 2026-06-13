<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();       // Ejemplo: MED001
            $table->string('nombre');                 // Ejemplo: Paracetamol 500mg
            $table->string('principio_activo');       // Ejemplo: Acetaminofén
            $table->decimal('precio', 8, 2);          // Ejemplo: 5.50
            $table->integer('stock');                 // Cantidad disponible en tienda
            $table->boolean('requiere_receta')->default(false); // true (sí) o false (no)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
