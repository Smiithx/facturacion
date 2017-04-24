<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
   protected $table = 'empresa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rezon_social',     
        'representante',
        'nit',

        'direccion', 
        'telefono',
        'file'
    
    
    ];
   }
