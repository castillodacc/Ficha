<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'username' => 'empleado',
            'password' => bcrypt('empleado'),
        ]);
    }
}
