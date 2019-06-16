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
        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(JornadasTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(FichasTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(PoblacionesTableSeeder::class);
        for ($i=0; $i < 10; $i++) \App\Empresa::create(['nombre' => 'Empresa ' . $i]);
    }
}
