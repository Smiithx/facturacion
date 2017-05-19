<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Manuales;
class Contratos extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contratos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'contrato',
        'nombre',
        'nit',
        'diasvencimiento',
        'id_manual',
        'porcentaje',
        'estado'
    ];

    public function manuales(){
        return $this->belongsTo(Manuales::class);
    }

    public function scopeNombre($query,$nombre){
        if(trim($nombre) != ""){
            $query->where('nombre',"LIKE","%$nombre%");
        }
    }
    
    public function getIdManualAttribute($value)
    {
        return Manuales::find($value);
    }


}
