<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'id_user' => 2,
            'nombre' => 'Pedro',
            'apellido' => 'Navaja',
            'dni' => '123456',
            'correo' => 'correo@correo.correo',
            'direccion' => 'mi direccion',
            'telefono' => '54654',
            'telefono_movil' => '365854',
        ]);

    }
}
