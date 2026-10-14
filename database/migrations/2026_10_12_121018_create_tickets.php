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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->index();
            $table->integer('tipo')->index();
            $table->string('descripcion')->nullable();
            $table->decimal('importe', $precision = 18, $scale = 4)->default(0);
            $table->timestamps();
        });

        Schema::table('movimientos', function (Blueprint $table) {
            $table->bigInteger('ticket_id')->unsigned()->nullable();

            $table->foreign('ticket_id')
                  ->references('id')->on('tickets');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
        });

        Schema::dropIfExists('tickets');
    }
};
