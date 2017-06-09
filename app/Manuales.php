<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Servicios;
use App\Contratos;
class Manuales extends Model
{
    protected $table = 'manuales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'nombre',
        'estado',
        'created_at',
        'updated_at'
    ];

    public function scopeNombre($query,$nombre){
        if(trim($nombre) != ""){
            $query->where('nombre',"LIKE","%$nombre%");
        }
    }


}
