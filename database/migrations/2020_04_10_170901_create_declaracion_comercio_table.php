<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclaracionComercioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_comercio', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcomercio');
            $table->foreign('idcomercio')->references('id')->on('comercios');
            $table->unsignedInteger('idperiodo');
            $table->foreign('idperiodo')->references('id')->on('periodos');
            $table->unsignedInteger('idtipo');
            $table->foreign('idtipo')->references('id')->on('tipo_contribuyente_comercio');
            $table->integer('tipo_declaracion');
            $table->float('monto_declaracion', 14, 2);
            $table->float('monto_impuesto', 14, 2);
            $table->string('estado');
            $table->unsignedInteger('idpago')->nullable();
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
        Schema::dropIfExists('declaracion_comercio');
    }
}
