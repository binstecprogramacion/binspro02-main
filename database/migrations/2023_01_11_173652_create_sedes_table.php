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
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->string('nomSede',60);
            $table->string('direccion',100);
            $table->string('metraje',10)->nullable();

            $table->unsignedBigInteger('alcances_id');
            $table->unsignedBigInteger('cuenta_id');

            $table  ->foreign('alcances_id')
                    ->references('id')
                    ->on('alcances')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                    
            $table->foreign('cuenta_id')
                    ->references('id')
                    ->on('cuentas')
                    //onDelete('cascade') permite que al eliminar 
                    //la tabla de la cual ereda el id, tmb se elimine la el dato actual
                    ->onDelete('cascade')
                    //si se llagara amodificar el id del cual ase referencian tmb se cambiaria
                    ->onUpdate('cascade');

            $table->timestamps();//SE CREA DOS COLUMNAS
                                //FECHA DE CREACION  -- FECHA ACTUALIZACION
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
};
