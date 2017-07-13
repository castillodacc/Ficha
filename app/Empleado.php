<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $guarded = ['id'];

    /**
     * Get the jornada for empleado.
     */
    public function jornada()
    {
        return $this->belongsTo('App\Empleado');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function fichas()
    {
        return $this->hasMany('App\Ficha');
    }
}
