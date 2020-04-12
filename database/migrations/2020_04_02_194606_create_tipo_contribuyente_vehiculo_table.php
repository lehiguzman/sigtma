<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoContribuyenteVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_contribuyente_vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo');
            $table->string('tipo');
            $table->string('descripcion');
            $table->float('monto_ut');
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
        Schema::dropIfExists('tipo_contribuyente_vehiculo');
    }
}
