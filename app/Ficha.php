<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
        'fecha',
        'hora_inicio',
        'hora_fin',
        'hora_inicio_comida',
        'hora_fin_comida',
        'hora_inicio_extras',
        'hora_fin_extras',
    ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
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
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
    }

    public function getHoraFinAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
    }

    public function setHoraInicioComidaAttribute($hora)
    {
        if($hora) {
            $this->attributes['hora_inicio_comida'] =  Carbon::createFromFormat('H:i', $hora);
        }
    }

    public function setHoraFinComidaAttribute($hora)
    {
        if($hora) {
            $this->attributes['hora_fin_comida'] = Carbon::createFromFormat('H:i', $hora);
        }
    }

    public function getHoraInicioComidaAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
    }

    public function getHoraFinComidaAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
    }

    public function setHoraInicioExtrasAttribute($hora)
    {
        if($hora) {
            $this->attributes['hora_inicio_extras'] =  Carbon::createFromFormat('H:i', $hora);
        }
    }

    public function setHoraFinExtrasAttribute($hora)
    {
        if($hora) {
            $this->attributes['hora_fin_extras'] = Carbon::createFromFormat('H:i', $hora);
        }
    }

    public function getHoraInicioExtrasAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
    }

    public function getHoraFinExtrasAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
    }
}
