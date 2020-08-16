<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{    
	protected $table = "registro";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];
}
