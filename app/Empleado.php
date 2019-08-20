<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Ficha;
use Carbon\Carbon;

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
        'deleted_at',
    ];

    protected $guarded = ['id'];

    /**
     * Get the jornada for empleado.
     */
    public function jornada()
    {
        return $this->belongsTo('App\Jornada');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function fichas()
    {
        return $this->hasMany('App\Ficha');
    }

    public function clienteAsignado()
    {
        return ($this->cliente_id) ? TRUE : FALSE;
    }

    public function jornadaAsignada()
    {
        return ($this->jornada_id) ? TRUE : FALSE;
    }

    public function jornadaAbierta()
    {
        $jornada_abierta = Ficha::where('empleado_id',$this->id)
                         ->where('estado','en progreso')->get()->first();
        return $jornada_abierta ? TRUE : FALSE;
    }

    public function horaRangoIniciarJornada()
    {
        $hora_actual    = Carbon::now();
        $inicio_jornada = Carbon::createFromFormat('H:i', $this->jornada->hora_inicio_jornada);
        $fin_jornada    = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);

        return ($this->libre) ?: $hora_actual->between($inicio_jornada->subMinutes(30), $fin_jornada->subMinute());
    }

    public function horaRangoFinalizarJornada()
    {
        $ficha = Ficha::where('empleado_id', $this->id)
               ->where('estado', 'en progreso')->get()->first();

        $hora_actual             = Carbon::now();
        $inicio_jornada_asignada = Carbon::createFromFormat('H:i', $this->jornada->hora_inicio_jornada);
        $inicio_ficha            = Carbon::createFromFormat('H:i', $ficha->hora_inicio);

        $inicio_jornada = ($inicio_ficha->gt($inicio_jornada_asignada)) ? $inicio_ficha : $inicio_jornada_asignada;
        $fin_jornada    = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);

        return ($this->libre) ?: $hora_actual->between($inicio_jornada->addMinutes(30), $fin_jornada->addMinutes(30));
    }

    public function jornadaAdmiteHorasExtras()
    {
        return $this->jornada->horas_extras;
    }

    public function horaRangoInicioHorasExtras()
    {
        $hora_actual = Carbon::now();
        $fin_jornada = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);
        $prorroga    = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);
        return($hora_actual->between($fin_jornada, $prorroga->addMinutes(30)));
    }

    public function horaRangoFinHorasExtras()
    {
        $ficha = Ficha::where('empleado_id',$this->id)
               ->where('estado','en progreso')->get()->first();
        $hora_actual   = Carbon::now();
        $inicio_extras = Carbon::createFromFormat('H:i', $ficha->hora_inicio_extras);
        $fin_extras    = Carbon::now()->addHours(8);
        return($hora_actual->between($inicio_extras, $fin_extras));
    }

    public function horasExtrasIniciadas()
    {
        $ficha = Ficha::where('empleado_id',$this->id)
               ->where('estado','en progreso')->get()->first();

        return($ficha->hora_inicio_extras ? TRUE : FALSE);
    }

    public function horasExtrasFinalizadas()
    {
        $ficha = Ficha::where('empleado_id',$this->id)
               ->where('estado','en progreso')->get()->first();

        return($ficha->hora_fin_extras ? TRUE : FALSE);
    }

    public function jornadaAdmiteTiempoDescanso()
    {
        return $this->jornada->hora_comida;
    }

    public function horaRangoTiempoDescanso()
    {
        $hora_actual            = Carbon::now();
        $inicio_tiempo_descanso = Carbon::createFromFormat('H:i', $this->jornada->hora_inicio_comida);
        $fin_tiempo_descanso    = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_comida);

        return $hora_actual->between($inicio_tiempo_descanso, $fin_tiempo_descanso);
    }

    public function tiempoDescansoIniciado()
    {
        $ficha = Ficha::where('empleado_id',$this->id)
                         ->where('estado','en progreso')->get()->first();

        return $ficha->hora_inicio_comida ? TRUE : FALSE;
    }

    public function tiempoDescansoFinalizado()
    {
        $ficha = Ficha::where('empleado_id',$this->id)
                         ->where('estado','en progreso')->get()->first();

        return $ficha->hora_fin_comida ? TRUE : FALSE;
    }

    public function getEstadoFichaDiaActual()
    {
        $ficha = Ficha::whereDate('fecha', Carbon::now()->format('Y-m-d'))
               ->where('empleado_id', $this->id)
               ->first();
        return(($ficha) ? $ficha->estado : "no laborado");
    }

    public function primeraJornada()
    {
        $ficha = Ficha::whereDate('fecha', Carbon::now()->format('Y-m-d'))
               ->where('empleado_id', $this->id)
               ->first();
        return((!($ficha ? TRUE : FALSE)));
    }

    public static function fechasParaReporte($fecha_i, $fecha_f, $used = [], $empleado_id = null, $cliente = null)
    {
        if ($empleado_id) {
            $empleados = Self::where('id', $empleado_id)->get();
        } elseif ($cliente) {
            $empleados = Self::where('cliente_id', $cliente->id)->get();
        } else {
            $empleados = Self::all();
        }
        $rows = [];
        $fecha_i = \Carbon::parse($fecha_i);
        $fecha_f = \Carbon::parse($fecha_f);
        do {
            $f_i = (isset($f_i)) ? $f_i->addDay(1) : $fecha_i;
            foreach ($empleados as $e) {
                if (in_array($f_i->format('Y-m-d'), explode(',', $e->vacaciones))) {
                    $row = [
                        'nombre' => $e->nombre . ' ' . $e->apellido,
                        'fecha' => $f_i->format('d/m/Y'),
                        'dni' => $e->dni,
                        'tipo' => 'VACACIONES'
                    ];
                    if (!in_array($row, $used)) $rows[] = $row;
                }
                if (in_array($f_i->format('Y-m-d'), explode(',', $e->festivos))) {
                    $row = [
                        'nombre' => $e->nombre . ' ' . $e->apellido,
                        'fecha' => $f_i->format('d/m/Y'),
                        'dni' => $e->dni,
                        'tipo' => 'FESTIVO'
                    ];
                    if (!in_array($row, $used)) $rows[] = $row;
                }
                if (in_array($f_i->format('Y-m-d'), explode(',', $e->bajas_ausencias))) {
                    $row = [
                        'nombre' => $e->nombre . ' ' . $e->apellido,
                        'fecha' => $f_i->format('d/m/Y'),
                        'dni' => $e->dni,
                        'tipo' => 'BAJA O AUSENCIA'
                    ];
                    if (!in_array($row, $used)) $rows[] = $row;
                }
            }
        } while ($f_i <= $fecha_f);
        return $rows;
    }
}
