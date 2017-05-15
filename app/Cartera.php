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
        'fecha_vencimiento',
        'valor_abono',
        'valor_abono',     
        'valor_glosa',
        'valor_retencion',     
        'valor_saldo'
    
    
    ];
}
