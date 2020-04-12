<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idtipocontribuyentevehiculo', 'denominacion', 'modelo', 'placa', 'serial', 'anio', 'rif', 'direccion', 'telefono'
    ];
}
