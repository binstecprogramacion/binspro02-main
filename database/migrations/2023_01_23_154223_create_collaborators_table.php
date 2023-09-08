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
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pirsons_id')->unique();
            $table->unsignedBigInteger('cargos_id');
            $table->unsignedBigInteger('cuentas_id');

            $table->foreign('pirsons_id')
                    ->references('id')
                    ->on('pirsons')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('cargos_id')
                    ->references('id')
                    ->on('cargos')
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
        Schema::dropIfExists('collaborators');
    }
};
