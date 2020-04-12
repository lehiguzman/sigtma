<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alicuota extends Model
{
   	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'denominacion', 'minimo_ut', 'maximo_ut', 'ut'
    ];
}
