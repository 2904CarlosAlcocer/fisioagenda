<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'paciente_id',
        'fisioterapeuta_id',
        'sala_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'motivo',
        'observaciones',
        'estado',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function recordatorios()
{
    return $this->hasMany(Recordatorio::class);
}

    public function fisioterapeuta()
    {
        return $this->belongsTo(Fisioterapeuta::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}