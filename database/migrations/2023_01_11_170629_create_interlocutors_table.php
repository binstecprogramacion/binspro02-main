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
        Schema::create('interlocutors', function (Blueprint $table) {
            
            $table->id();
            $table->string('nombre',150);
            $table->string('apellidos',150);
            $table->string('correo',100);
            $table->string('telefono',9);
            $table->string('descripcion')->nullable();

            $table->unsignedBigInteger('cuenta_id');
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
        Schema::dropIfExists('interlocutors');
    }
};
