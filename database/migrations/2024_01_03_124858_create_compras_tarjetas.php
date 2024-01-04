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
        Schema::create('compras_tarjetas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tarjeta_id')->unsigned();
            $table->bigInteger('categoria_id')->unsigned();
            $table->date('fecha');
            $table->string('descripcion');
            $table->decimal('total', $precision = 18, $scale = 4);
            $table->decimal('importeCuota', $precision = 18, $scale = 4);
            $table->integer('cuotas');
            $table->integer('cuotasPendientes');
            $table->date('periodoInicial');

            $table->timestamps();

            $table->foreign('tarjeta_id')
                ->references('id')->on('tarjetas');
            $table->foreign('categoria_id')
                ->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras_tarjetas', function (Blueprint $table) {
            $table->dropForeign(['tarjeta_id']);
        });
        Schema::table('compras_tarjetas', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
        });

        Schema::dropIfExists('compras_tarjetas');
    }
};
