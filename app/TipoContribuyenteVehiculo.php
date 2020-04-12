<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContribuyenteVehiculo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'tipo', 'descripcion', 'monto_ut'
    ];
}
