<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Manuales;

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
        'estado' ,
        'id'
    ];


    public function manuales(){
        return $this->hasMany(Manuales::class);
    }
}
