<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sala;

class SalaSeeder extends Seeder
{
    public function run(): void
    {
        $salas = [
            ['nombre' => 'Sala 1', 'descripcion' => 'Sala de atención fisioterapéutica'],
            ['nombre' => 'Sala 2', 'descripcion' => 'Sala de atención fisioterapéutica'],
            ['nombre' => 'Sala 3', 'descripcion' => 'Sala de atención fisioterapéutica'],
            ['nombre' => 'Sala 4', 'descripcion' => 'Sala de atención fisioterapéutica'],
        ];

        foreach ($salas as $sala) {
            Sala::create($sala);
        }
    }
}