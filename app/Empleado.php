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
        $hora_actual = Carbon::now()->format('H:i');
        $inicio_jornada = $this->jornada->hora_inicio_jornada;
        $fin_jornada = $this->jornada->hora_fin_jornada;

        return($hora_actual->between($inicio_jornada->subMinutes(30),$fin_jornada->subSecond()));
    }

    public function horaRangoFinalizarJornada()
    {
        $hora_actual = Carbon::now()->format('H:i');
        $fin_jornada = $this->jornada->hora_fin_jornada;
        $fin_jornada_prorroga = $this->jornada->hora_fin_jornada->addMinutes(30);

        return($hora_actual->between($fin_jornada,$fin_jornada_prorroga));
    }

    public function jornadaAdmiteHorasExtras()
    {
        return $this->jornada->horas_extras ? TRUE : FALSE;
    }

    public function horaRangoHorasExtras()
    {
        $hora_actual = Carbon::now()->format('H:i');
        $fin_jornada = $this->jornada->hora_fin_jornada;

        return($hora_actual->between($fin_jornada->subMinutes(30),$fin_jornada->addMinutes(30)));
    }

    public function jornadaAdmiteTiempoDescanso()
    {
        return $this->jornada->hora_inicio_comida AND $this->jornada->hora_fin_comida;
    }

    public function horaRangoTiempoDescanso()
    {
        $hora_actual            = Carbon::now()->format('H:i');
        $inicio_tiempo_descanso = $this->jornada->hora_inicio_comida;
        $fin_tiempo_descanso    = $this->jornada->hora_fin_comida;

        return $hora_actual->between($fin_jornada,$fin_jornada_prorroga);
    }

    public function tiempoDescansoIniciado()
    {
        $ficha = Ficha::where('empleado_id',$this->id)
                         ->where('estado','abierta')->get()->first();

        return $ficha->hora_inicio_comida ? TRUE : FALSE;
    }

}
