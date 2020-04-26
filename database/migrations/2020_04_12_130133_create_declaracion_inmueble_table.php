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
            $table->float('area_terreno', 12, 2);
            $table->float('area_construccion', 12,2);
            $table->integer('tipo_declaracion');
            $table->float('valor_total', 12, 2);
            $table->float('monto_impuesto', 12, 2);
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
        Schema::dropIfExists('declaracion_inmueble');
    }
}
