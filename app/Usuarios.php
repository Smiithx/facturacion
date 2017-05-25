<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'documento',
        'contraseña',
        'firma',
        'cargo'
    ];

    public function scopeNombre($query,$nombre){
        if(trim($nombre) != ""){
            $query->where('nombre',"LIKE","%$nombre%");
        }
    }

}
