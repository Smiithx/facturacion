<?php

namespace App;

use Carbon\Carbon;
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
    protected $fillable = ["id", 'documento', 'tipo_documento', 'nombre', 'fecha_nacimiento', 'sexo', 'telefono', 'direccion', 'aseguradora_id', 'id_contrato', 'regimen'];

    public function aseguradora()
    {
        return $this->belongsTo(Aseguradora::class);
    }

    public function scopeName($query, $nombre)
    {
        if (trim($nombre) != "") {
            $query->where('nombre', "LIKE", "%$nombre%");
        }
    }

    public function getEdad()
    {
        $fecha = Carbon::createFromFormat('Y-m-d', $this->fecha_nacimiento);
        $años = $fecha->age;

        if ($años >= 1) {
            $edad = ($años > 1) ? $años . " años" : $años . " año";
        } else {
            $meses = $fecha->diffInMonths();
            if ($meses > 0) {
                $edad = $meses > 1 ? $meses . " meses" : $meses . " mes";
            }else{
                $dias = $fecha->diffInDays();
                if ($dias > 0){
                    $edad = $dias > 1 ? $dias . " días" : $dias . " día";
                }else{
                    $edad = $dias . " días";
                }
            }
        }
        return $edad;
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
