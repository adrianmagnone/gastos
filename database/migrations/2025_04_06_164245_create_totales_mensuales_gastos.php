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
        Schema::create('totales_mensuales_gastos', function (Blueprint $table) {
            $table->id();
            $table->date('periodo')->index();
            $table->decimal('total_ingresos', $precision = 18, $scale = 4)->default(0);
            $table->decimal('total_egresos', $precision = 18, $scale = 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totales_mensuales_gastos');
    }
};
