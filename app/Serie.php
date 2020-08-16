<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{

	protected $table = "serie";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idregistro', 'valor1', 'valor2', 'valor3', 'valor4', 'valor5', 'resultado1' ,'resultado2'
    ];
}
