<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclaracionInmueble extends Model
{
    protected $table = "declaracion_inmueble";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idinmueble', 'idperiodo', 'idzona', 'tipo_vivienda', 'idregimen', 'area_terreno', 'area_construccion', 'tipo_declaracion', 'valor_total', 'monto_impuesto'
    ];
}
