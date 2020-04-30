<?php

use Illuminate\Database\Seeder;
use App\TipoContribuyenteVehiculo;

class TipoContribuyenteVehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Automoviles y Camionetas Particulares';
        $tipoVehiculo->descripcion = 'Automoviles y Camionetas Particulares';
        $tipoVehiculo->monto_ut = 1;        
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Carros libres, Por puestos y Camionetas por pasajeros';
        $tipoVehiculo->descripcion = 'Carros libres, Por puestos y Camionetas por pasajeros';
        $tipoVehiculo->monto_ut = 1.50;        
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Autobuses y Minibuses';
        $tipoVehiculo->descripcion = 'Automoviles y Camionetas Particulares';
        $tipoVehiculo->monto_ut = 2;        
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Vehiculos de carga de 3000 Kg';
        $tipoVehiculo->descripcion = 'Vehiculos de carga de 3000 Kg';
        $tipoVehiculo->monto_ut = 3;        
        $tipoVehiculo->save();   

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Camionetas y Gandolas';
        $tipoVehiculo->descripcion = 'Camionetas y Gandolas';
        $tipoVehiculo->monto_ut = 5;        
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Remolque Adicional';
        $tipoVehiculo->descripcion = 'Remolque Adicional';
        $tipoVehiculo->monto_ut = 2;        
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Motocicletas, Motonetas y Similares';
        $tipoVehiculo->descripcion = 'Motocicletas, Motonetas y Similares';
        $tipoVehiculo->monto_ut = 0.5;        
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoContribuyenteVehiculo();        
        $tipoVehiculo->tipo = 'Bicicleta de reparto, deportivas de paseo y similares';
        $tipoVehiculo->descripcion = 'Bicicleta de reparto, deportivas de paseo y similares';
        $tipoVehiculo->monto_ut = 0.1;        
        $tipoVehiculo->save();
    }
}
