<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('movimientos_mios', 'movimientos_fondos');

        Schema::table('movimientos_fondos', function (Blueprint $table) {
            $table->bigInteger('fondo_id')->unsigned()->nullable();

            $table->foreign('fondo_id')
                  ->references('id')->on('fondos');
        });

        DB::statement("UPDATE movimientos_fondos SET fondo_id = 2");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimientos_fondos', function (Blueprint $table) {
            $table->dropForeign(['fondo_id']);
        });
        
        Schema::rename('movimientos_fondos', 'movimientos_mios');
    }
};
