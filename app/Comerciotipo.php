<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comerciotipo extends Model
{
    //
    protected $table = "comercios_tipo";

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
    	'idtipo', 'idcomercio'
    ];
}
