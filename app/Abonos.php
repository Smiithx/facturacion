<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonos extends Model
{
    protected $fillable = [
        'id_factura',     
        'descripcion',
        'anulado',
        'valor_abono'
        ];
}
