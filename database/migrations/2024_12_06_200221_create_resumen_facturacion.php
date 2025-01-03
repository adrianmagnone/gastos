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
        Schema::create('resumen_facturacion', function (Blueprint $table) {
            $table->id();
            $table->integer('anio')->index();
            $table->integer('mes')->index();
            $table->date('periodo')->index();
            $table->bigInteger('cuenta_id')->unsigned();
            $table->decimal('importe', $precision = 18, $scale = 4)->default(0);
            $table->timestamps();

            $table->foreign('cuenta_id')
                  ->references('id')->on('cuentas_facturacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumen_facturacion', function (Blueprint $table) {
            $table->dropForeign(['cuenta_id']);
        });
        Schema::dropIfExists('resumen_facturacion');
    }
};
