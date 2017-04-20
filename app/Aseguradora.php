<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aseguradora extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aseguradoras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    public function pacientes(){
        return $this->hasMany(Paciente::class);
    }
}