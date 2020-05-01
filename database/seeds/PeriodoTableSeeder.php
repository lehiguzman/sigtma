<?php

use Illuminate\Database\Seeder;
use App\Periodo;

class PeriodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$periodo = new Periodo();
        $periodo->periodo = 2018;
        $periodo->unidad_tributaria = 50;		
        $periodo->save();

        $periodo = new Periodo();
        $periodo->periodo = 2019;
        $periodo->unidad_tributaria = 50;		
        $periodo->save();

        $periodo = new Periodo();
        $periodo->periodo = 2020;
        $periodo->unidad_tributaria = 1500;       
        $periodo->save();
    }
}
