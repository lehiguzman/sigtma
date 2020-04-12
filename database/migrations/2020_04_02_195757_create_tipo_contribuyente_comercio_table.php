<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoContribuyenteComercioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_contribuyente_comercio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo');
            $table->string('denominacion');
            $table->string('descripcion');
            $table->float('alicuota_anual');
            $table->float('minimo_tributable');
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
        Schema::dropIfExists('tipo_contribuyente_comercio');
    }
}
