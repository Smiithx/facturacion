<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FacturaItems;
use Carbon\Carbon;

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
        'id_contrato',
        'created_at',
        'factura_total',
        'anulado'
    ];

    public function FacturaItems()
    {
        return $this->belongsTo(FacturaItems::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $fecha = $fecha->format('Y-m-d');
        return $fecha;
    }
    public function getIdContratoAttribute($value)
    {
        return \App\Contratos::find($value);
    }
}
