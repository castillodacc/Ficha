<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TipoContrato::create(['nombre' => 'Sin Determinar']);
        \App\TipoContrato::create(['nombre' => 'Contrato Indefinido']);
        \App\TipoContrato::create(['nombre' => 'Contrato Obra']);
        \App\TipoContrato::create(['nombre' => 'Contrato Servicio']);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(JornadasTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(FichasTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(PoblacionesTableSeeder::class);
        $empresa = \App\Poblacion::all()->toArray();
        for ($i=0; $i < 10; $i++) {
            \App\Empresa::create([
                'nombre' => 'Empresa ' . $i,
                'poblacion_id' => $empresa[rand(0, count($empresa)-1)]['id'],
                'correo' => 'empresa_' . $i . '@correo.com',
                'detalles' => 'Detalles...',
                'direccion' => 'Direccion...',
                'cif' => rand(100000, 999999),
            ]);
        }
    }
}