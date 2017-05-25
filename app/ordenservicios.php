<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ordenservicios extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ordendeservicio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'documento', 'aseguradora_id','id_contrato','orden_total','id_paciente','anulada','created_at'];

    public function aseguradora(){
        return $this->belongsTo(Aseguradora::class);
    }
     public function contratos(){
        return $this->belongsTo(Contratos::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $fecha = $fecha->format('Y-m-d');
        return $fecha;
    }
    public function getAseguradoraIdAttribute($value)
    {
        return \App\Aseguradora::find($value);
    }
    public function getIdContratoAttribute($value)
    {
        return \App\Contratos::find($value);
    }
}
