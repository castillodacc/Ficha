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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'activa' => 'boolean',
        'horas_extras' => 'boolean',
        'hora_comida' => 'boolean',
    ];

    /**
     * Get the empleados for the jornada.
     */
    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }

    protected $guarded = ['id'];

    public function setHoraInicioJornadaAttribute($hora)
    {
        $this->attributes['hora_inicio_jornada'] =  Carbon::createFromFormat('H:i', $hora);
    }

    public function setHoraFinJornadaAttribute($hora)
    {
        $this->attributes['hora_fin_jornada'] = Carbon::createFromFormat('H:i', $hora);
    }

    public function getHoraInicioJornadaAttribute($hora)
    {
        return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
    }

    public function getHoraFinJornadaAttribute($hora)
    {
        return(Carbon::createFromFormat('Y-m-d H:i:s', $hora)->format('H:i'));
    }

}
