<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pacientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['documento', 'tipo_documento', 'nombre','edad','tipo_edad','fecha_nacimiento','sexo','telefono','direccion','aseguradora_id','contrato','regimen'];

    public function aseguradora(){
        return $this->belongsTo(Aseguradora::class);
    }

    public function scopeName($query,$nombre){
        if(trim($nombre) != ""){
            $query->where('nombre',"LIKE","%$nombre%");
        }
    }
    
    public function getAseguradoraIdAttribute($value)
    {
        return \App\Aseguradora::find($value);
    }

}
