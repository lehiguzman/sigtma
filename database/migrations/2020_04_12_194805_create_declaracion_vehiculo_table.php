<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclaracionVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idvehiculo');
            $table->foreign('idvehiculo')->references('id')->on('vehiculos');
            $table->unsignedInteger('idperiodo');
            $table->foreign('idperiodo')->references('id')->on('periodos');
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
        Schema::dropIfExists('declaracion_vehiculo');
    }
}
