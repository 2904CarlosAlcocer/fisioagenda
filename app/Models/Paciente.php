<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombre',
        'cedula',
        'telefono',
        'edad',
        'correo',
        'direccion',
        'motivo_visita',
        'observaciones',
        'estado',
    ];
}