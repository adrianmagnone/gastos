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
        Schema::create('mantenimiento_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->integer('km')->unsigned();
            $table->decimal('importe', $precision = 18, $scale = 4)->default(0);
            $table->string('descripcion');
            $table->timestamps();

            $table->foreign('vehiculo_id')
                  ->references('id')->on('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mantenimiento_vehiculos', function (Blueprint $table) {
            $table->dropForeign(['vehiculo_id']);
        });

        Schema::dropIfExists('mantenimiento_vehiculos');
    }
};
