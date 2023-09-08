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
        Schema::create('contindiferidos', function (Blueprint $table) {
            $table->id();
            $table->string('partida');
            $table->double('Saldo',20,2);
            $table->double('SaldoRestante',20,2);
            $table->string('anio');
            
            $table->unsignedBigInteger('cuentas_id');
            $table->unsignedBigInteger('catcontingencias_id');

            
            $table->foreign('cuentas_id')
                    ->references('id')
                    ->on('cuentas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('catcontingencias_id')
                    ->references('id')
                    ->on('catcontingencias')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');



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
        Schema::dropIfExists('contindiferidos');
    }
};
