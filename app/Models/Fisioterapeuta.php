<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fisioterapeuta extends Model
{
    protected $fillable = [
        'user_id',
        'especialidad',
        'telefono',
        'horario',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}