<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class OthersUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'pedro@ficha.com',
            'password' => bcrypt('pedro'),
            'activo' => false,
            'created_at' => Carbon::now(),
        ]);
    }
}
