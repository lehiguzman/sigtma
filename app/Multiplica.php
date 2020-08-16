<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multiplica extends Model
{
	protected $table = "Multiplica";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idregistro', 'valor1', 'valor2', 'resultado'
    ];
}
