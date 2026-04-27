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
    Schema::create('recordatorios', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cita_id')->constrained('citas')->onDelete('cascade');
        $table->date('fecha_recordatorio');
        $table->text('mensaje');
        $table->enum('estado', ['pendiente', 'enviado', 'no_contactado'])->default('pendiente');
        $table->timestamp('enviado_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recordatorios');
    }
};
