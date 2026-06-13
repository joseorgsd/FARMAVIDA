<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = ['colegiatura_cmp', 'nombre_completo'];
}
