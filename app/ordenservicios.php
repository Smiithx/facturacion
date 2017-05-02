<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['nombre', 'documento', 'aseguradora_id','contrato','orden_total','created_at'];

    public function aseguradora(){
        return $this->belongsTo(Aseguradora::class);
    }

}
