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
        Schema::create('requerimientos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('tipo_servicio');
        $table->string('tipo_area');
        $table->integer('asignacion')->nullable();
        $table->text('descripcion');
        $table->string('imagen')->nullable();
        $table->text('estado');

        $table->unsignedBigInteger('cuentas_id');
        $table->unsignedBigInteger('sedes_id');
        $table->unsignedBigInteger('users_id');
        $table->unsignedBigInteger('htcategorias_id')->nullable();
        //$table->unsignedBigInteger('omologados_id')->nullable();
        //$table->unsignedBigInteger('collaborators_id')->nullable();

        $table->foreign('cuentas_id')
                ->references('id')
                ->on('cuentas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        $table->foreign('sedes_id')
                ->references('id')
                ->on('sedes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        $table->foreign('htcategorias_id')
                ->references('id')
                ->on('htcategorias')
                ->onDelete('set null')
                ->onUpdate('cascade');
/* 
            $table->foreign('omologados_id')
                    ->references('id')
                    ->on('omologados')
                    ->onDelete('set null')
                    ->onUpdate('set null');

            $table->foreign('collaborators_id')
                    ->references('id')
                    ->on('collaborators')
                    ->onDelete('set null')
                    ->onUpdate('set null');
*/
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
        Schema::dropIfExists('requerimientos');
    }
};
