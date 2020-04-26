<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{

	protected $table = "regimen";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'regimen', 'alicuota'
    ];
}
