<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idtipocontribuyentevehiculo');
            $table->foreign('idtipocontribuyentevehiculo')->references('id')->on('tipo_contribuyente_vehiculo');
            $table->string('denominacion');
            $table->string('modelo')->nullable();
            $table->string('placa');
            $table->string('serial')->nullable();            
            $table->string('rif');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
}
