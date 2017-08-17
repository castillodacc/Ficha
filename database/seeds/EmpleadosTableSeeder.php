<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert([
            'user_id' => 2,
            'cliente_id' => 1,
            'jornada_id' => 1,
            'nombre' => 'Pedro',
            'apellido' => 'Navaja',
            'dni' => '123456',
            'correo' => 'correo@correo.correo',
            'direccion' => 'mi direccion',
            'telefono' => '54654',
            'telefono_movil' => '365854',
            'created_at' => Carbon::now(),
        ]);

    }
}
