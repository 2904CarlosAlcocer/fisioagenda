<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $fillable = [
        'cita_id',
        'fecha_recordatorio',
        'mensaje',
        'estado',
        'enviado_at',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}