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
        Schema::create('proveedos', function (Blueprint $table) {
            $table->id();
            $table->string('rucProv',15);
            $table->string('razSocProv',100);
            $table->string('nombProv',100);
            $table->string('celularProv',9);
            $table->string('correoProv',100);
            
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
        Schema::dropIfExists('proveedos');
    }
};
