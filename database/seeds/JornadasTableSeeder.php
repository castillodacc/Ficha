<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JornadasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jornadas')->insert([
            'nombre'              => 'jornada1',
            'tipo'                => 'diurna',
            'horas_laborales'     => '02:30',
            'hora_inicio_jornada' => '2017-08-17 10:30:00',
            'hora_fin_jornada'    => '2017-08-17 13:00:00',
            'created_at'          => Carbon::now(),
        ]);
    }
}
