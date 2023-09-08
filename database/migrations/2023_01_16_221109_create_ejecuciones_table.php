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
        Schema::create('ejecuciones', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->double('Costo',20,2);
            $table->double('Precio',20,2);
            $table->string('estado_ejecucion')->nullable();

            $table->unsignedBigInteger('pams_id')->unique();
            $table->unsignedBigInteger('omologados_id')->nullable();

            $table->foreign('pams_id')
                    ->references('id')
                    ->on('pams')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('omologados_id')
                    ->references('id')
                    ->on('omologados')
                    ->onDelete('set null')
                    ->onUpdate('set null');

            
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
        Schema::dropIfExists('ejecuciones');
    }
};
