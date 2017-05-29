<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class FacturaItems extends Model
{
    protected $table = 'factura_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_factura',
        'id_orden_servicio',
    ];

    public function getIdOrdenServicioAttribute($value)
    {
        return \App\ordenservicios::find($value);
    }
    public function getIdFacturaAttribute($value)
    {
        return \App\Factura::find($value);
    }

}
