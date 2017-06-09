<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manuales_servicios extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manuales_servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["id",'id_manual', 'codigosoat', 'id_servicio', 'estado','costo','created_at','updated_at'];

    public function getIdManualAttribute($value)
    {
        return \App\Manuales::find($value);
    }

    public function getIdServicioAttribute($value)
    {
        return \App\Servicios::find($value);
    }
    
}
