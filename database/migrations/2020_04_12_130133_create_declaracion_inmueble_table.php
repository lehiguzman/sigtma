<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclaracionInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_inmueble', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idinmueble');
            $table->foreign('idinmueble')->references('id')->on('inmuebles');
            $table->unsignedInteger('idperiodo');
            $table->foreign('idperiodo')->references('id')->on('periodos');
            $table->unsignedInteger('idzona');
            $table->foreign('idzona')->references('id')->on('zonas');
            $table->string('tipo_vivienda');
            $table->unsignedInteger('idregimen');
            $table->foreign('idregimen')->references('id')->on('regimen');
            $table->float('area_terreno');
            $table->float('area_construccion');
            $table->float('valor_total');
            $table->float('monto_impuesto');
            $table->string('estado');
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
        Schema::dropIfExists('declaracion_inmueble');
    }
}
