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
        Schema::create('pams', function (Blueprint $table) {
            $table->id();

            $table->string('estado');
            $table->string('mes');

            $table->unsignedBigInteger('htestructuras_id');
            $table->unsignedBigInteger('sedes_id');
            $table->unsignedBigInteger('cuentas_id');

            $table->foreign('htestructuras_id')
                    ->references('id')
                    ->on('htestructuras')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('sedes_id')
                    ->references('id')
                    ->on('sedes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('cuentas_id')
                    ->references('id')
                    ->on('cuentas')
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
        Schema::dropIfExists('pams');
    }
};
