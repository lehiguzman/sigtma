<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlicuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alicuotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion');
            $table->float('minimo_ut')->nullable();
            $table->float('maximo_ut')->nullable();
            $table->float('ut')->nullable();
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
        Schema::dropIfExists('alicuotas');
    }
}
