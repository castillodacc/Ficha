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
        $fichas_abiertas = Ficha::where('estado','abierta')->get();
        $hora_actual = Carbon::now()->format('H:i');

        foreach($fichas_abiertas as $ficha_abierta) {
            $empleado = $ficha_abierta->empleado;
            $jornada = $empleado->jornada;
            $fin_jornada = $jornada->hora_fin_jornada->addMinutes(30);
            if($hora_actual->gt($fin_jornada)) {
                $ficha_abierta->estado = 'cerrada';
                $ficha_abierta->hora_fin = $jornada->hora_fin_jornada;
                $ficha_abierta->save();
            }
        }

    }
}
