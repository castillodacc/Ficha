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
    }
}
