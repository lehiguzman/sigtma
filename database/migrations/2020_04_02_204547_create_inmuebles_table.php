<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idtipocontribuyenteinmueble');
            $table->foreign('idtipocontribuyenteinmueble')->references('id')->on('tipo_contribuyente_inmueble');
            $table->string('denominacion');
            $table->string('codigo_catastral');
            $table->string('numero_civico');
            $table->unsignedInteger('idzona');
            $table->foreign('idzona')->references('id')->on('zonas');
            $table->string('tipo_vivienda');
            $table->unsignedInteger('idregimen');
            $table->foreign('idregimen')->references('id')->on('regimen');
            $table->string('numero_inscripcion');
            $table->float('area_terreno', 12, 2);
            $table->float('area_construccion', 12, 2);
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
        Schema::dropIfExists('inmuebles');
    }
}
