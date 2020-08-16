<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comparacion extends Model
{
	protected $table = "comparacion";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idregistro', 'valor1', 'valor2', 'resultado' ,'intentos'
    ];
}
