<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenServicio_Items extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orden_servicio_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_orden_servicio', 'cups','descripcion','cantidad','copago','valorunitario','valortotal'];
}
