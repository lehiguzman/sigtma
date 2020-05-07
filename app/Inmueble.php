<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'denominacion', 'codigo_catastral', 'ultima_declaracion', 'numero_civico', 'idzona', 'tipo_vivienda', 'numero_inscripcion', 'anio', 'area_terreno', 'area_construccion', 'rif', 'direccion', 'telefono'
    ];
}
