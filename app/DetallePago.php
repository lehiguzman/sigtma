<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_pago', 'referencia', 'banco', 'monto', 'fecha_pago', 'idpago'
    ];
}
