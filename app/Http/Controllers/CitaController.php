<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Fisioterapeuta;
use App\Models\Sala;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['paciente', 'fisioterapeuta.user', 'sala'])
            ->latest()
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $fisioterapeutas = Fisioterapeuta::with('user')->get();
        $salas = Sala::orderBy('nombre')->get();

        $fecha = null;
        $hora_inicio = null;
        $hora_fin = null;

        if ($request->filled('inicio')) {
            $inicio = Carbon::parse($request->inicio);

            $fecha = $inicio->format('Y-m-d');
            $hora_inicio = $inicio->format('H:i');
            $hora_fin = $inicio->copy()->addHour()->format('H:i');
        }

        return view('citas.create', compact(
            'pacientes',
            'fisioterapeutas',
            'salas',
            'fecha',
            'hora_inicio',
            'hora_fin'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required',
            'fisioterapeuta_id' => 'required',
            'sala_id' => 'required',
            'estado' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'motivo' => 'required',
            'observaciones' => 'nullable',
        ]);

        $datos = $request->all();

        $datos['hora_fin'] = Carbon::parse($request->hora_inicio)
            ->addHour()
            ->format('H:i');

        Cita::create($datos);

        return redirect()->route('citas.calendario')
            ->with('success', 'Cita registrada correctamente');
    }

    public function edit(Cita $cita)
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $fisioterapeutas = Fisioterapeuta::with('user')->get();
        $salas = Sala::orderBy('nombre')->get();

        return view('citas.edit', compact(
            'cita',
            'pacientes',
            'fisioterapeutas',
            'salas'
        ));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'paciente_id' => 'required',
            'fisioterapeuta_id' => 'required',
            'sala_id' => 'required',
            'estado' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'motivo' => 'required',
            'observaciones' => 'nullable',
        ]);

        $datos = $request->all();

        $datos['hora_fin'] = Carbon::parse($request->hora_inicio)
            ->addHour()
            ->format('H:i');

        $cita->update($datos);

        return redirect()->route('citas.calendario')
            ->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada correctamente');
    }

    public function calendario()
    {
        return view('citas.calendario');
    }

    public function eventos()
    {
        $citas = Cita::with(['paciente', 'fisioterapeuta.user', 'sala'])->get();

        $eventos = [];

        foreach ($citas as $cita) {
            $color = match ($cita->estado) {
                'pendiente' => '#f59e0b',
                'confirmada' => '#3b82f6',
                'atendida' => '#22c55e',
                'cancelada' => '#ef4444',
                default => '#ec4899',
            };

            $eventos[] = [
                'id' => $cita->id,
                'title' =>
                    ($cita->paciente->nombre ?? 'Paciente') .
                    ' - ' .
                    ($cita->fisioterapeuta->user->name ?? 'Fisioterapeuta'),

                'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                'end' => $cita->fecha . 'T' . $cita->hora_fin,

                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => '#ffffff',

                'url' => route('citas.edit', $cita->id),

                'extendedProps' => [
                    'estado' => $cita->estado,
                    'motivo' => $cita->motivo ?? '',
                    'sala' => $cita->sala->nombre ?? '',
                ],
            ];
        }

        return response()->json($eventos);
    }

    public function mover(Request $request, Cita $cita)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $cita->update([
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cita movida correctamente'
        ]);
    }
}