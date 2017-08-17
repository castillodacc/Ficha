<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nombre' => 'Sra. Juana',
            'telefono' => '0414524562',
            'correo' => 'correo@gmail.com',
            'direccion' => 'En la calle con la segunda',
            'observaciones' => 'Muy bien todo, ninguna novedad.',
            'created_at' => Carbon::now(),
        ]);
        DB::table('clientes')->insert([
            'nombre' => 'Dr. Andres',
            'telefono' => '0414524562',
            'correo' => 'correo@gmail.com',
            'direccion' => 'En la calle con la segunda',
            'observaciones' => 'Muy bien todo, solo que no tiene tarjeta de credito y hay que estar pendientes con el pago en su caso.',
            'created_at' => Carbon::now(),
        ]);
    }
}
