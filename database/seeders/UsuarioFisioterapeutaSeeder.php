<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Fisioterapeuta;
use Illuminate\Support\Facades\Hash;

class UsuarioFisioterapeutaSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Fisioterapeuta 1',
            'email' => 'fisio1@fisioagenda.com',
            'password' => Hash::make('12345678'),
        ]);

        Fisioterapeuta::create([
            'user_id' => $user1->id,
            'telefono' => '8888-8888',
            'especialidad' => 'Fisioterapia general',
            'estado' => 'activo',
        ]);

        $user2 = User::create([
            'name' => 'Fisioterapeuta 2',
            'email' => 'fisio2@fisioagenda.com',
            'password' => Hash::make('12345678'),
        ]);

        Fisioterapeuta::create([
            'user_id' => $user2->id,
            'telefono' => '7777-7777',
            'especialidad' => 'Rehabilitación física',
            'estado' => 'activo',
        ]);
    }
}