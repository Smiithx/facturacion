<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosticos extends Model
{
       protected $table = 'diagnosticos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',     
        'descripcion',
        'estado',
        'id'
    ];

    public function scopeCodigo($query,$codigo){
        if(trim($codigo) != ""){
            $query->where('codigo',"LIKE","%$codigo%");
        }
    }

}
