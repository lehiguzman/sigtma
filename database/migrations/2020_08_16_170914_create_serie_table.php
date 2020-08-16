<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idregistro');
            $table->foreign('idregistro')->references('id')->on('registro');
            $table->integer('valor1');
            $table->integer('valor2');
            $table->integer('valor3');
            $table->integer('valor4');
            $table->integer('valor5');
            $table->integer('resultado1');
            $table->integer('resultado2');
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
        Schema::dropIfExists('serie');
    }
}
