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
    protected $fillable = ['documento', 'tipo_documento', 'nombre','edad','tipo_edad','fecha_nacimiento','sexo','telefono','direccion','aseguradora','contrato','regimen'];

    public function aseguradora(){
        return $this->belongsTo(Aseguradora::class);
    }

}
