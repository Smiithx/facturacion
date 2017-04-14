<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimientos extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'procedimientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cups', 'descripcion', 'pos'];
}
