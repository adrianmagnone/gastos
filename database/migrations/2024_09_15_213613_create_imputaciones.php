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
        Schema::create('imputaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('comprobante_debe')->unsigned();
            $table->bigInteger('comprobante_haber')->unsigned();
            $table->decimal('importe', $precision = 13, $scale = 2)->default(0);
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
        Schema::dropIfExists('imputaciones');
    }
};
