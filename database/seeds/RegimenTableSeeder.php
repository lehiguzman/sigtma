<?php

use Illuminate\Database\Seeder;
use App\Regimen;

class RegimenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regimen = new Regimen();
        $regimen->regimen = "PIN";
        $regimen->alicuota = 0.60;		
        $regimen->save();

        $regimen = new Regimen();
        $regimen->regimen = "COM";
        $regimen->alicuota = 0.80;		
        $regimen->save();

        $regimen = new Regimen();
        $regimen->regimen = "IND";
        $regimen->alicuota = 0.90;		
        $regimen->save();

        $regimen = new Regimen();
        $regimen->regimen = "SERV";
        $regimen->alicuota = 0.80;		
        $regimen->save();

        $regimen = new Regimen();
        $regimen->regimen = "TERRENO CON SERVICIO";
        $regimen->alicuota = 1.25;		
        $regimen->save();

        $regimen = new Regimen();
        $regimen->regimen = "TERRENO CON SERVICIO";
        $regimen->alicuota = 1.50;		
        $regimen->save();
    }
}
