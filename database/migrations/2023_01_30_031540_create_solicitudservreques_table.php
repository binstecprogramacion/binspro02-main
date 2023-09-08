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
        Schema::create('solicitudservreques', function (Blueprint $table) {
            $table->id();
            $table->double('costo',20,2);
            $table->double('precio',20,2);
            $table->string('estado');
            $table->string('AprobacionADM')->nullable();
            $table->string('AprobacionJOP')->nullable();
            $table->string('AprobacionGG')->nullable();

            $table->unsignedBigInteger('omologados_id');
            $table->unsignedBigInteger('requerimientos_id')->unique();
            $table->unsignedBigInteger('contindiferidos_id');

            $table->foreign('omologados_id')
                ->references('id')
                ->on('omologados')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('requerimientos_id')
                ->references('id')
                ->on('requerimientos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('contindiferidos_id')
                ->references('id')
                ->on('contindiferidos')
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
        Schema::dropIfExists('solicitudservreques');
    }
};
