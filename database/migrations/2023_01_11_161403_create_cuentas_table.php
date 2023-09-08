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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('ruc')->unique();
            $table->string('razonSocial');

            $table->timestamps();//SE CREA DOS COLUMNAS
                                    //FECHA DE CREACION  -- FECHA ACTUALIZACION
            $table->boolean('estado')->nullable();

            $table->unsignedBigInteger('catcuentas_id')->nullable();
            $table->foreign('catcuentas_id')
                    ->references('id')
                    ->on('catcuentas')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
};
