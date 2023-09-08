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
        Schema::create('htestructuras', function (Blueprint $table) {
            $table->id();

            $table->string('anio');

            $table->unsignedBigInteger('htcategorias_id');
            
            $table->integer('cantidad');
            $table->string('frecuencia');
            $table->integer('numfrecuencia');
            $table->double('CostoUnitario',20,2);
            $table->double('CostoMensual',20,2);
            $table->double('CostoAnual',20,2);
            $table->double('CostoAnualRestante',20,2)->nullable();
            $table->double('PrecioUnitario',20,2);
            $table->double('PrecioMensual',20,2);
            $table->double('PrecioAnual',20,2);
            $table->double('PrecioAnualRestante',20,2)->nullable();
            
            $table->unsignedBigInteger('cuentas_id');

            $table->foreign('cuentas_id')
                    ->references('id')
                    ->on('cuentas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                    
            $table->foreign('htcategorias_id')
                    ->references('id')
                    ->on('htcategorias')
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
        Schema::dropIfExists('htestructuras');
    }
};
