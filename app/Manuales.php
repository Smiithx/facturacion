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
        'tipo',    
        'codigosoat',
        'estado',
        'created_at',
        'updated_at'
    ];

    public function scopeSoat($query,$soat){
        if(trim($soat) != ""){
            $query->where('codigosoat',"LIKE","%$soat%");
        }
    }

}
