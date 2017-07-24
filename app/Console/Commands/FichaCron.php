<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Empleado;
use App\Ficha;
use App\Jornada;
use Carbon\Carbon;

class FichaCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ficha:cerrar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cierra fichas que pasaron horario de la jornada';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fichas_abiertas = Ficha::where('estado', 'en progreso')->get();
        $hora_actual = Carbon::now();
        foreach($fichas_abiertas as $ficha_abierta) {
            $empleado = $ficha_abierta->empleado;
            $jornada = $empleado->jornada;
            $fin_jornada = Carbon::createFromFormat('H:i', $jornada->hora_fin_jornada);
            if($hora_actual->gt($fin_jornada->addMinutes(30))) {
                if($jornada->horas_extras AND $ficha_abierta->hora_inicio_extras) {
                    $inicio_extras = $ficha_abierta->hora_inicio_extras;
                    if($hora_actual->gt($inicio_extras->addHours(8))) {
                        $fin_extras = $ficha_abierta->hora_inicio_extras;
                        $ficha_abierta->hora_fin_extras = $fin_extras->addHour();
                        $ficha_abierta->estado = 'cerrado';
                        $ficha_abierta->save();
                    }
                } else {
                $ficha_abierta->estado = 'cerrado';
                $ficha_abierta->hora_fin = $jornada->hora_fin_jornada;
                $ficha_abierta->save();
                }
            }
        }
    }
}
