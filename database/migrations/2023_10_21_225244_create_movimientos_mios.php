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
        Schema::create('movimientos_mios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('tipo');
            $table->bigInteger('concepto_id')->unsigned();
            $table->string('descripcion')->nullable();
            $table->decimal('importe', $precision = 18, $scale = 4)->default(0);
            $table->decimal('saldo',   $precision = 18, $scale = 4)->default(0);
            $table->timestamps();

            $table->index('fecha');
            $table->index('saldo');

            $table->foreign('concepto_id')
                  ->references('id')->on('conceptos_mios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimientos_mios', function (Blueprint $table) {
            $table->dropForeign(['concepto_id']);
        });
        Schema::dropIfExists('movimientos_mios');
    }
};
