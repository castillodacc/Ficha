<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ficha extends Model
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
        'deleted_at',
        'hora_inicio',
        'hora_fin',
    ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }


    public function cliente()
    {
        return $this->belongsTo('App\Client');
    }

    public function setHoraInicioAttribute($hora)
    {
        if($hora) {
            $this->attributes['hora_inicio'] =  Carbon::createFromFormat('H:i', $hora);
        }
    }

    public function setHoraFinAttribute($hora)
    {
        if($hora) {
            $this->attributes['hora_fin'] = Carbon::createFromFormat('H:i', $hora);
        }
    }

    public function getHoraInicioAttribute($hora)
    {
        return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
    }

    public function getHoraFinAttribute($hora)
    {
        return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
    }

}
