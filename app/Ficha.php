<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Empleado;
use App\Cliente;

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
            return($hora_fin->diff($hora_inicio)->format('%H:%I'));
        }
        return("00:00");
    }

    public function getTotalHorasExtras()
    {
        if($this->hora_inicio_extras AND $this->hora_fin_extras) {
            $hora_inicio = Carbon::createFromFormat('H:i', $this->hora_inicio_extras);
            $hora_fin    = Carbon::createFromFormat('H:i', $this->hora_fin_extras);
            return($hora_fin->diff($hora_inicio)->format('%H:%I'));
        }
        return("00:00");
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

    function horasTrabajadasEmpleado($empleado, $fecha_inicio, $fecha_fin)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->where('empleado_id', $empleado)
                ->whereDate('fecha', '>=', $fecha_inicio)
                ->whereDate('fecha', '<=', $fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_t = $ficha->getTotalHorasTrabajadas();
                if($horas_t) {
                    $tiempo_t = explode(":", $horas_t);
                    $tiempo_trabajado->addHours($tiempo_t[0]);
                    $tiempo_trabajado->addMinutes($tiempo_t[1]);
                }
            }
            return($tiempo_trabajado->diff($hora)->format('%Dd:%Hh:%Im'));
        } else {
            return("00h:00m");
        }
    }

    function horasExtrasTrabajadasEmpleado($empleado, $fecha_inicio, $fecha_fin)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->where('empleado_id', $empleado)
                ->whereDate('fecha', '>=', $fecha_inicio)
                ->whereDate('fecha', '<=', $fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora          = Carbon::today();
            $tiempo_extras = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_e = $ficha->getTotalHorasExtras();
                if($horas_e) {
                    $tiempo_e = explode(":", $horas_e);
                    $tiempo_extras->addHours($tiempo_e[0]);
                    $tiempo_extras->addMinutes($tiempo_e[1]);
                }
            }
            return($tiempo_extras->diff($hora)->format('%Dd:%Hh:%Im'));
        } else {
            return("00h:00m");
        }
    }

    function getNombreEmpleado($empleado)
    {
        $empleado = Empleado::select('nombre')
                  ->where('id', $empleado)
                  ->first();
        return(($empleado) ? $empleado->nombre : "N/D");
    }

    function horasTrabajadasCliente($cliente, $fecha_inicio, $fecha_fin)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->where('cliente_id', $cliente)
                ->whereDate('fecha', '>=', $fecha_inicio)
                ->whereDate('fecha', '<=', $fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_t = $ficha->getTotalHorasTrabajadas();
                if($horas_t) {
                    $tiempo_t = explode(":", $horas_t);
                    $tiempo_trabajado->addHours($tiempo_t[0]);
                    $tiempo_trabajado->addMinutes($tiempo_t[1]);
                }
            }
            return($tiempo_trabajado->diff($hora)->format('%Dd:%Hh:%Im'));
        } else {
            return("00h:00m");
        }
    }

    function horasExtrasTrabajadasCliente($cliente, $fecha_inicio, $fecha_fin)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->where('cliente_id', $cliente)
                ->whereDate('fecha', '>=', $fecha_inicio)
                ->whereDate('fecha', '<=', $fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora          = Carbon::today();
            $tiempo_extras = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_e = $ficha->getTotalHorasExtras();
                if($horas_e) {
                    $tiempo_e = explode(":", $horas_e);
                    $tiempo_extras->addHours($tiempo_e[0]);
                    $tiempo_extras->addMinutes($tiempo_e[1]);
                }
            }
            return($tiempo_extras->diff($hora)->format('%Dd:%Hh:%Im'));
        } else {
            return("00h:00m");
        }
    }

    function getNombreCliente($cliente)
    {
        $cliente = Cliente::select('nombre')
                  ->where('id', $cliente)
                  ->first();
        return(($cliente) ? $cliente->nombre : "N/D");
    }

}
