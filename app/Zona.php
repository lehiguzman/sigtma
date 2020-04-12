<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'c1', 'c2', 'c3', 'c4', 'v1', 'v2', 'v3', 'v4'
    ];
}
