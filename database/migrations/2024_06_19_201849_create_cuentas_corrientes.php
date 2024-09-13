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
        // Schema::create('tipos_comprobantes', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('descripcion');
        //     $table->integer('codigoAfip')->index();
        //     $table->integer('tipo')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('abreviatura')->nullable();
            $table->bigInteger('tipoDocumento')->unsigned();
            $table->bigInteger('identificador')->unique();
            $table->timestamps();
        });

        Schema::create('cuentas_corrientes_facturacion', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuenta_id')->unsigned();
            $table->date('fecha');
            $table->bigInteger('tipoComprobante_id')->unsigned();
            $table->integer('puntoVenta');
            $table->integer('numeroComprobante');
            $table->bigInteger('tipoDocumento')->unsigned();
            $table->bigInteger('identificadorComprador');
            $table->bigInteger('persona_id')->unsigned();
            $table->decimal('importe', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importeNoGravado', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importePercepcion', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importeExento', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importePercepcionNacional', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importePercepcionIB', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importePercepcionMunicipal', $precision = 13, $scale = 2)->default(0);
            $table->decimal('importeImpuestoInterno', $precision = 13, $scale = 2)->default(0);
            $table->decimal('saldo', $precision = 13, $scale = 2)->default(0);
            $table->string('columna', 1);


            $table->timestamps();

            $table->foreign('cuenta_id')
                  ->references('id')->on('cuentas_facturacion');
            $table->foreign('persona_id')
                  ->references('id')->on('personas');
            $table->foreign('tipoComprobante_id')
                  ->references('id')->on('tipos_comprobantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuentas_corrientes_facturacion', function (Blueprint $table) {
            $table->dropForeign(['cuenta_id', 'persona_id', 'tipoComprobante_id']);
        });
        Schema::dropIfExists('cuentas_corrientes_facturacion');

        Schema::dropIfExists('personas');
    }
};
