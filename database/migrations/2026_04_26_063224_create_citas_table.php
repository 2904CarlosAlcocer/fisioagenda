<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
        $table->foreignId('fisioterapeuta_id')->constrained('fisioterapeutas')->onDelete('cascade');
        $table->foreignId('sala_id')->constrained('salas')->onDelete('cascade');

        $table->date('fecha');
        $table->time('hora_inicio');
        $table->time('hora_fin');

        $table->text('motivo')->nullable();
        $table->text('observaciones')->nullable();

        $table->enum('estado', [
            'programada',
            'confirmada',
            'atendida',
            'cancelada',
            'no_asistio'
        ])->default('programada');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
