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
        Schema::create('omologados', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('proveedos_id');
            $table->unsignedBigInteger('alcances_id');
            $table->unsignedBigInteger('htcategorias_id');
            $table->string('codigo_Unico')->unique();

            $table  ->foreign('htcategorias_id')
                    ->references('id')
                    ->on('htcategorias')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table  ->foreign('alcances_id')
                    ->references('id')
                    ->on('alcances')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table  ->foreign('proveedos_id')
                    ->references('id')
                    ->on('proveedos')
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
        Schema::dropIfExists('omologados');
    }
};
