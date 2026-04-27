<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('salas', function (Blueprint $table) {

            if (!Schema::hasColumn('salas', 'ubicacion')) {
                $table->string('ubicacion')->nullable()->after('nombre');
            }

            if (!Schema::hasColumn('salas', 'capacidad')) {
                $table->integer('capacidad')->nullable()->after('ubicacion');
            }

            if (!Schema::hasColumn('salas', 'descripcion')) {
                $table->text('descripcion')->nullable()->after('estado');
            }

        });
    }

    public function down(): void
    {
        Schema::table('salas', function (Blueprint $table) {

            if (Schema::hasColumn('salas', 'ubicacion')) {
                $table->dropColumn('ubicacion');
            }

            if (Schema::hasColumn('salas', 'capacidad')) {
                $table->dropColumn('capacidad');
            }

            if (Schema::hasColumn('salas', 'descripcion')) {
                $table->dropColumn('descripcion');
            }

        });
    }
};