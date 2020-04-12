<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');            
            $table->float('c1');
            $table->float('c2');
            $table->float('c3');
            $table->float('c4');
            $table->float('v1');
            $table->float('v2');
            $table->float('v3');
            $table->float('v4');            
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
        Schema::dropIfExists('zonas');
    }
}
