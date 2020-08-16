<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suma extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idregistro', 'valor1', 'valor2', 'resultado' ,'intentos'
    ];
}
