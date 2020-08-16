<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComparacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparacion', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idregistro');
            $table->foreign('idregistro')->references('id')->on('registro');
            $table->integer('valor1');
            $table->integer('valor2');
            $table->integer('resultado');
            $table->integer('intentos');
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
        Schema::dropIfExists('comparacion');
    }
}
