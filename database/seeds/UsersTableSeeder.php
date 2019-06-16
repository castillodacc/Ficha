<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
            'username' => 'admin@ficha.com',
            'is_admin' => true,
            'password' => bcrypt('admin'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'empleado1@ficha.com',
            'password' => bcrypt('empleado'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'empleado2@ficha.com',
            'password' => bcrypt('empleado'),
            'created_at' => Carbon::now(),
        ]);
    }
}
