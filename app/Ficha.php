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

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
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

    public function getFechaAttribute($fecha)
    {
        if($fecha) {
            return(Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->format('Y-m-d'));
        }
    }

    public function getTotalHorasTrabajadas()
    {
        if($this->hora_inicio AND $this->hora_fin) {
            $hora_inicio = Carbon::createFromFormat('H:i', $this->hora_inicio);
            $hora_fin    = Carbon::createFromFormat('H:i', $this->hora_fin);
            return($hora_fin->diff($hora_inicio)->format('%H:%i'));
        }
        return(0);
    }

    public function getTotalHorasExtras()
    {
        if($this->hora_inicio_extras AND $this->hora_fin_extras) {
            $hora_inicio = Carbon::createFromFormat('H:i', $this->hora_inicio_extras);
            $hora_fin    = Carbon::createFromFormat('H:i', $this->hora_fin_extras);
            return($hora_fin->diff($hora_inicio)->format('%H:%i'));
        }
        return(0);
    }

    public function getNombreEmpleados()
    {
        $nombres = "";
        if($this->cliente->empleado->count() === 1) {
            $nombres = $this->cliente->empleado->nombre;
        } else {
            foreach($this->cliente->empleado as $empleado) {
                $nombres .= $empleado->nombre.", ";
            }
        }

        return($nombres ?: "N/D");
    }
}
