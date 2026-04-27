<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    public function enviarMensaje(string $telefono, string $mensaje): void
    {
        $telefono = preg_replace('/[^0-9]/', '', $telefono);

        if (!str_starts_with($telefono, '506')) {
            $telefono = '506' . $telefono;
        }

        $client = new Client(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_AUTH_TOKEN')
        );

        $client->messages->create(
            'whatsapp:+' . $telefono,
            [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' => $mensaje,
            ]
        );
    }
}