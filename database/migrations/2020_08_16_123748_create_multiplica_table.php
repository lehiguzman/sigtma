<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultiplicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiplica', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idregistro');
            $table->foreign('idregistro')->references('id')->on('registro');
            $table->integer('valor1');
            $table->integer('valor2');
            $table->integer('resultado');            
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
        Schema::dropIfExists('multiplica');
    }
}
