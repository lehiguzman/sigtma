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
        'idtipocontribuyenteinmueble', 'denominacion', 'codigo_catastral', 'numero_civico', 'idzona', 'tipo_vivienda', 'numero_inscripcion', 'area_terreno', 'area_construccion', 'rif', 'direccion', 'telefono'
    ];
}
