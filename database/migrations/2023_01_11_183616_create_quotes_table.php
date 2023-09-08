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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCotCon',100);
            $table->string('pdfDoc');
            $table->string('anioCotCon',4);


            $table->unsignedBigInteger('cuenta_id');
            $table->unsignedBigInteger('documentation_id');

            $table->foreign('cuenta_id')
                    ->references('id')
                    ->on('cuentas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('documentation_id')
                    ->references('id')
                    ->on('documentations')
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
        Schema::dropIfExists('quotes');
    }
};
