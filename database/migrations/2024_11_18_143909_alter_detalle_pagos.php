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
        Schema::table('detalle_pagos_tarjetas', function (Blueprint $table) {
            $table->integer('cantidad')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_pagos_tarjetas', function (Blueprint $table) {
            $table->dropColumn(['cantidad']);
        });
    }
};
