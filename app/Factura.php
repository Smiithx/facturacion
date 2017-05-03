<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{



    protected $table = 'facturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'contrato',
        'created_at',
        'factura_total',
    ];
}
