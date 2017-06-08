<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cups',
        'descripcion',
        'estado',
        'id'
    ];

    public function scopeCups($query, $cup)
    {
        if (trim($cup) != "") {
            $query->where('cups', "LIKE", "%$cup%");
        }
    }

    public function scopeManualCups($query, $cup, $manual)
    {
        $query->selectRaw('servicios.cups,servicios.descripcion,manuales_servicios.*')
            ->join("manuales_servicios", "manuales_servicios.id_servicio", "=", "servicios.id")
            ->where("manuales_servicios.id_manual", $manual)
            ->where('servicios.cups', "LIKE", "%$cup%")
            ->orderBy("servicios.cups");
    }

}
