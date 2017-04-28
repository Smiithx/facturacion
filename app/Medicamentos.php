<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamentos extends Model
{
    protected $table = 'medicamentos';
    protected $fillable = ['descripcion', 'cum', 'pos'];
}
