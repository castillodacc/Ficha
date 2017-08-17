<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FichasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fichas')->insert([
            'empleado_id' => 1,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-17 10:33:33',
            'hora_inicio' => '2017-08-17 10:33:33',
            'hora_fin' => '2017-08-17 11:03:00',
            'created_at'          => '2017-08-17 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-17 10:33:33',
            'hora_inicio' => '2017-08-17 10:33:33',
            'hora_fin' => '2017-08-17 16:03:00',
            'created_at'          => '2017-08-17 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 2,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-17 10:33:33',
            'hora_inicio' => '2017-08-17 10:33:33',
            'hora_fin' => '2017-08-17 13:25:00',
            'created_at'          => '2017-08-17 10:33:33',
        ]);
    }
}
