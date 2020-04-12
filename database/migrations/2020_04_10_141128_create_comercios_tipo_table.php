<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComerciosTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comercios_tipo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcomercio');
            $table->foreign('idcomercio')->references('id')->on('comercios');
            $table->unsignedInteger('idtipo');
            $table->foreign('idtipo')->references('id')->on('tipo_contribuyente_comercio');
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
        Schema::dropIfExists('comercios_tipo');
    }
}
