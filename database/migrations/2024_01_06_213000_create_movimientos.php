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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('tipo');
            $table->bigInteger('categoria_id')->unsigned();
            $table->string('descripcion')->nullable();
            $table->decimal('importe', $precision = 18, $scale = 4)->default(0);
            $table->timestamps();

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
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
        });
        Schema::dropIfExists('movimientos');
    }
};
