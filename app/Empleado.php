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
        'deleted_at'
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

    public function fichas()
    {
        return $this->hasMany('App\Ficha');
    }

    public function jornadaAsignada()
    {
        return ($this->jornada_id) ? TRUE : FALSE;
    }

    public function jornadaAbierta()
    {
        $jornada_abierta = Ficha::where('empleado_id',$this->id)
                         ->where('estado','abierta')->get()->first();
        return $jornada_abierta ? TRUE : FALSE;
    }

    public function horaRangoIniciarJornada()
    {
        $hora_actual = Carbon::now();
        $inicio_jornada = Carbon::createFromFormat('H:i',$this->jornada->hora_inicio_jornada);
        $fin_jornada = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);

        return($hora_actual->between($inicio_jornada->subMinutes(30), $fin_jornada->subSecond()));
    }

    public function horaRangoFinalizarJornada()
    {
        $hora_actual = Carbon::now();
        $fin_jornada = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);
        $fin_jornada_prorroga = $fin_jornada;
        $fin_jornada_prorroga = $fin_jornada_prorroga->addMinutes(30);

        return($hora_actual->between($fin_jornada, $fin_jornada_prorroga));
    }

    public function jornadaAdmiteHorasExtras()
    {
        return $this->jornada->horas_extras ? TRUE : FALSE;
    }

    public function horaRangoHorasExtras()
    {
        $hora_actual = Carbon::now();
        $fin_jornada = Carbon::createFromFormat('H:i', $this->jornada->hora_fin_jornada);

        return($hora_actual->between($fin_jornada->subMinutes(30), $fin_jornada->addMinutes(30)));
    }

    public function jornadaAdmiteTiempoDescanso()
    {
        return($this->jornada->hora_inicio_comida AND $this->jornada->hora_fin_comida);
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
                         ->where('estado','abierta')->get()->first();

        return $ficha->hora_inicio_comida ? TRUE : FALSE;
    }

}
