<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclaracionComercio extends Model
{

	protected $table = "declaracion_comercio";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcomercio', 'idperiodo', 'idtipo', 'tipo_declaracion', 'monto'
    ];
}
