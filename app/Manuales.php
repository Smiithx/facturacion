<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Servicios;

class Manuales extends Model
{
    protected $table = 'manuales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipomanual', 
        'servicios_id',    
        
        'codigosoat', 
        'costo', 
        'estado'
    
    
    ];

     public function servicios(){
        return $this->belongsTo(Servicios::class);
    }
}
