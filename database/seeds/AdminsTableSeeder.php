<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'user_id' => 1,
            'nombre' => 'Juan Pachanga',
            // 'hereda_permisos' => true,
            'crea_admin' => true,
            'crea_cliente' => true,
            'crea_empleado' => true,
            'crea_jornada' => true,
            'gestiona_empleado' => true,
            'gestiona_cliente' => true,
            'gestiona_admin' => true,
            'gestiona_jornada' => true,
            'genera_reporte' => true,
            'created_at' => Carbon::now(),
        ]);

    }
}
