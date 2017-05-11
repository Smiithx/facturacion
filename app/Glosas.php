<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glosas extends Model
{
    protected $table = 'glosas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_factura',     
        'contrato',
        'valor_glosa',
        'valor_aceptado'
    
    
    ];
}
