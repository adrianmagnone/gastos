<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_anual_movimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('anio')->index();
            $table->integer('mes')->index();
            $table->integer('tipo')->index();
            $table->bigInteger('categoria_id')->unsigned();
            $table->decimal('importe', $precision = 18, $scale = 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumen_anual_movimientos');
    }
};
