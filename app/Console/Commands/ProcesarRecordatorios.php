<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Recordatorio;
use App\Services\WhatsAppService;
use Carbon\Carbon;

class ProcesarRecordatorios extends Command
{
    protected $signature = 'recordatorios:procesar';

    protected $description = 'Procesa recordatorios pendientes y los envía por WhatsApp';

    public function handle()
    {
        $recordatorios = Recordatorio::with('cita.paciente')
            ->where('estado', 'pendiente')
            ->where('fecha_recordatorio', '<=', Carbon::now())
            ->get();

        if ($recordatorios->isEmpty()) {
            $this->info('No hay recordatorios pendientes.');
            return;
        }

        $whatsapp = new WhatsAppService();

        foreach ($recordatorios as $recordatorio) {
            $paciente = $recordatorio->cita->paciente ?? null;

            if (!$paciente || !$paciente->telefono) {
                $this->error('Recordatorio sin paciente o sin teléfono.');
                continue;
            }

            try {
                $whatsapp->enviarMensaje(
                    $paciente->telefono,
                    $recordatorio->mensaje
                );

                $recordatorio->update([
                    'estado' => 'enviado',
                    'enviado_at' => Carbon::now(),
                ]);

                $this->info('WhatsApp enviado a: ' . $paciente->nombre);

            } catch (\Exception $e) {
                $this->error('Error enviando WhatsApp: ' . $e->getMessage());
            }
        }

        $this->info('Proceso finalizado.');
    }
}