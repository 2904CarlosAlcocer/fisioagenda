<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Sala;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        $citasHoy = Cita::whereDate('fecha', $hoy)->count();

        $pacientes = Paciente::count();

        $programadas = Cita::where('estado', 'programada')->count();

        $salas = Sala::count();

        $proximas = Cita::with('paciente')
            ->whereDate('fecha', $hoy)
            ->orderBy('hora_inicio')
            ->take(5)
            ->get();

        // Semana actual: lunes a domingo
        $semana = [];

        $inicioSemana = Carbon::now()->startOfWeek(Carbon::MONDAY);

        for ($i = 0; $i < 7; $i++) {
            $fecha = $inicioSemana->copy()->addDays($i);

            $semana[] = [
                'dia' => $fecha->locale('es')->isoFormat('ddd D/M'),
                'total' => Cita::whereDate('fecha', $fecha)->count(),
            ];
        }

        return view('dashboard', compact(
            'citasHoy',
            'pacientes',
            'programadas',
            'salas',
            'proximas',
            'semana'
        ));
    }
}