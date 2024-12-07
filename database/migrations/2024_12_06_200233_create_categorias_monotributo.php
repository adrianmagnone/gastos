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
        Schema::create('categorias_monotributo', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_vigencia')->index();
            $table->string('categoria', 10 );
            $table->decimal('importe_mensual', $precision = 18, $scale = 4)->default(0);
            $table->decimal('importe_anual',   $precision = 18, $scale = 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_monotributo');
    }
};
