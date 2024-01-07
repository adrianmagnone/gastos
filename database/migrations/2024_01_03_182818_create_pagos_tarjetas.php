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
        Schema::create('pagos_tarjetas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tarjeta_id')->unsigned();
            $table->date('periodoPago');
            $table->date('fechaPago');
            $table->decimal('totalCuotas',  $precision = 18, $scale = 4);
            $table->decimal('totalSeguros', $precision = 18, $scale = 4);
            $table->decimal('totalPagado',  $precision = 18, $scale = 4);
            $table->smallInteger('pasadoGasto')->default(0);
            $table->timestamps();

            $table->foreign('tarjeta_id')
                ->references('id')->on('tarjetas');
        });

        Schema::create('detalle_pagos_tarjetas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pago_id')->unsigned();
            $table->bigInteger('compra_id')->unsigned();
            $table->decimal('importe', $precision = 18, $scale = 4);
            $table->timestamps();

            $table->foreign('pago_id')
                ->references('id')->on('pagos_tarjetas');
            $table->foreign('compra_id')
                ->references('id')->on('compras_tarjetas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_pagos_tarjetas', function (Blueprint $table) {
            $table->dropForeign(['pago_id']);
        });
        Schema::table('detalle_pagos_tarjetas', function (Blueprint $table) {
            $table->dropForeign(['compra_id']);
        });

        Schema::dropIfExists('detalle_pagos_tarjetas');


        Schema::table('pagos_tarjetas', function (Blueprint $table) {
            $table->dropForeign(['tarjeta_id']);
        });

        Schema::dropIfExists('pagos_tarjetas');
    }
};
