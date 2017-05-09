<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
   protected $table = 'cartera';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_factura',     
        'contrato',
        'retencion'
    
    
    ];
}
