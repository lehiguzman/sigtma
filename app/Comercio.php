<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comercio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'licencia', 'rif', 'denominacion', 'fecha_inscripcion', 'cedula', 'direccion', 'telefono'
    ];    

    /**
     * Comercio has many Tipo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tipos()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = empleado_id, localKey = id)
        return $this->hasMany(TipoContribuyenteComercio::class);
    }


}
