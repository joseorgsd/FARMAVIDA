<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = 'medicamentos';
    protected $fillable = ['codigo', 'nombre', 'principio_activo', 'precio', 'stock', 'requiere_receta'];
}
