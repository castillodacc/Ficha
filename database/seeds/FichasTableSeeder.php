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
            'fecha' => '2017-08-15 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-15 10:33:33',
            'hora_fin' => '2017-08-15 13:03:00',
            'created_at'          => '2017-08-15 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-15 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-15 10:33:33',
            'hora_fin' => '2017-08-15 14:43:00',
            'created_at'          => '2017-08-15 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 2,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-15 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-15 10:33:33',
            'hora_fin' => '2017-08-15 13:25:00',
            'created_at'          => '2017-08-15 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 1,
            'cliente_id' => 2,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-15 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-15 10:33:33',
            'hora_fin' => '2017-08-15 13:25:00',
            'created_at'          => '2017-08-15 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 1,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-16 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-16 10:33:33',
            'hora_fin' => '2017-08-16 12:08:00',
            'created_at'          => '2017-08-16 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-16 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-16 10:33:33',
            'hora_fin' => '2017-08-16 16:29:00',
            'created_at'          => '2017-08-16 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 2,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-16 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-16 10:33:33',
            'hora_fin' => '2017-08-16 15:25:00',
            'created_at'          => '2017-08-16 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 1,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-17 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-17 10:33:33',
            'hora_fin' => '2017-08-17 13:54:00',
            'created_at'          => '2017-08-17 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 1,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-17 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-17 10:33:33',
            'hora_fin' => '2017-08-17 13:03:00',
            'created_at'          => '2017-08-17 10:33:33',
        ]);
        DB::table('fichas')->insert([
            'empleado_id' => 2,
            'cliente_id' => 2,
            'estado'     => 'cerrado',
            'fecha' => '2017-08-17 10:33:33',
            'tiempo_por_trabajar'     => '02:30',
            'hora_inicio' => '2017-08-17 10:33:33',
            'hora_fin' => '2017-08-17 13:25:00',
            'created_at'          => '2017-08-17 10:33:33',
        ]);
    }
}
