<?php

namespace App\Http\Controllers;

use App\Models\Recordatorio;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RecordatorioController extends Controller
{
    public function index()
    {
        $recordatorios = Recordatorio::with('cita.paciente')
            ->latest()
            ->get();

        return view('recordatorios.index', compact('recordatorios'));
    }

    public function create()
    {
        $citas = Cita::with('paciente')
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        return view('recordatorios.create', compact('citas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cita_id' => 'required|exists:citas,id',
            'fecha_recordatorio' => 'required|date',
            'mensaje' => 'required|string',
        ]);

        Recordatorio::create([
            'cita_id' => $request->cita_id,
            'fecha_recordatorio' => $request->fecha_recordatorio,
            'mensaje' => $request->mensaje,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('recordatorios.index')
            ->with('success', 'Recordatorio creado correctamente');
    }

    public function destroy(Recordatorio $recordatorio)
    {
        $recordatorio->delete();

        return redirect()->route('recordatorios.index')
            ->with('success', 'Recordatorio eliminado correctamente');
    }

    public function marcarEnviado(Recordatorio $recordatorio)
    {
        $recordatorio->update([
            'estado' => 'enviado',
            'enviado_at' => Carbon::now(),
        ]);

        return redirect()->route('recordatorios.index')
            ->with('success', 'Recordatorio marcado como enviado');
    }
}