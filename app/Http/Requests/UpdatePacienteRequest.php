<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:150',
            'cedula' => 'nullable|string|max:30',
            'telefono' => 'required|string|max:30',
            'edad' => 'nullable|integer|min:0|max:120',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string',
            'motivo_visita' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
        ];
    }
}