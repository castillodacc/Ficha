<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Jornada extends Model
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
        'hora_inicio_jornada',
        'hora_fin_jornada',
        'hora_inicio_comida',
        'hora_fin_comida',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'activa' => 'boolean',
        'hora_extras' => 'boolean',
    ];


    protected $guarded = ['id'];

    public function setHoraInicioJornadaAttribute($hora)
    {
        $this->attributes['hora_inicio_jornada'] =  Carbon::createFromFormat('H:i', $hora);
    }

    public function setHoraFinJornadaAttribute($hora)
    {
        $this->attributes['hora_fin_jornada'] = Carbon::createFromFormat('H:i', $hora);
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

    public function getHoraInicioJornadaAttribute($hora)
    {
        return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
    }

    public function getHoraFinJornadaAttribute($hora)
    {
        return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
    }

    public function getHoraInicioComidaAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
        return($hora);
    }

    public function getHoraFinComidaAttribute($hora)
    {
        if($hora) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
        }
        return($hora);
    }

}
