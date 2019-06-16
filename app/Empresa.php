<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre',
    	'telefono',
    	'contacto',
    	'correo',
    	'direccion'
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [ # $dates
        'created_at' , 'updated_at', 'deleted_at'
    ];
}
