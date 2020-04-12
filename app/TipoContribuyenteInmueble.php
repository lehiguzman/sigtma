<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContribuyenteInmueble extends Model
{

	protected $table = "tipo_contribuyente_inmueble";
 	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numeral', 'descripcion', 'exonerado', 'idalicuota'
    ];
}
