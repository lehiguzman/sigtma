<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclaracionVehiculo extends Model
{
	
    protected $table = "declaracion_vehiculo";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idvehiculo', 'idperiodo', 'tipo_declaracion', 'monto_impuesto', 'idpago'
    ];
}
