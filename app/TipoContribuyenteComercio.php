<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContribuyenteComercio extends Model
{

	protected $table = "tipo_contribuyente_comercio";
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'denominacion', 'descripcion', 'alicuota_anual', 'minimo_tributable'
    ];


    /**
     * TipoContribuyenteComercio has many Comercio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comercios()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = empleado_id, localKey = id)
        return $this->hasMany(Comercio::class);
    }
}
