<?php

use Illuminate\Database\Seeder;
use App\Zona;

class ZonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zona = new Zona();
        $zona->nombre = "Zona 1";
        $zona->c1 = 0.37;		
        $zona->c2 = 1.37;		
        $zona->c3 = 3.37;		
        $zona->c4 = 4.37;		
        $zona->v1 = 7.07;		
        $zona->v2 = 8.07;		
        $zona->v3 = 9.07;		
        $zona->v4 = 10.07;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 2";
        $zona->c1 = 0.38;		
        $zona->c2 = 1.38;		
        $zona->c3 = 3.38;		
        $zona->c4 = 4.38;		
        $zona->v1 = 7.08;		
        $zona->v2 = 8.08;		
        $zona->v3 = 9.08;		
        $zona->v4 = 10.08;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 3";
        $zona->c1 = 0.39;		
        $zona->c2 = 1.39;		
        $zona->c3 = 3.39;		
        $zona->c4 = 4.39;		
        $zona->v1 = 7.09;		
        $zona->v2 = 8.09;		
        $zona->v3 = 9.09;		
        $zona->v4 = 10.09;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 4";
        $zona->c1 = 0.4;		
        $zona->c2 = 1.4;		
        $zona->c3 = 3.4;		
        $zona->c4 = 4.4;		
        $zona->v1 = 7.4;		
        $zona->v2 = 8.4;		
        $zona->v3 = 9.4;		
        $zona->v4 = 10.4;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 5";
        $zona->c1 = 0.41;		
        $zona->c2 = 1.41;		
        $zona->c3 = 3.41;		
        $zona->c4 = 4.41;		
        $zona->v1 = 7.11;		
        $zona->v2 = 8.11;		
        $zona->v3 = 9.11;		
        $zona->v4 = 10.11;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 6";
        $zona->c1 = 1.41;		
        $zona->c2 = 2.41;		
        $zona->c3 = 4.41;		
        $zona->c4 = 5.41;		
        $zona->v1 = 8.11;		
        $zona->v2 = 9.11;		
        $zona->v3 = 10.11;		
        $zona->v4 = 11.11;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 7";
        $zona->c1 = 2.41;		
        $zona->c2 = 3.41;		
        $zona->c3 = 5.41;		
        $zona->c4 = 6.41;		
        $zona->v1 = 9.11;		
        $zona->v2 = 10.11;		
        $zona->v3 = 11.11;		
        $zona->v4 = 12.11;
        $zona->save();

        $zona = new Zona();
        $zona->nombre = "Zona 8";
        $zona->c1 = 3.41;		
        $zona->c2 = 4.41;		
        $zona->c3 = 6.41;		
        $zona->c4 = 7.41;		
        $zona->v1 = 10.11;		
        $zona->v2 = 11.11;		
        $zona->v3 = 12.11;		
        $zona->v4 = 13.11;
        $zona->save();

    }
}
