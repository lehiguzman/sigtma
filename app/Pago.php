<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_pago', 'referencia', 'banco', 'fecha_pago', 'tipo_contribuyente'
    ];
}
