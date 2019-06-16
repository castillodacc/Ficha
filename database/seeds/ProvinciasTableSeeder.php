<?php

use Illuminate\Database\Seeder;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if (is_readable(storage_path('app/public/provinces.json'))) {
    		$lines = file(storage_path('app/public/provinces.json', FILE_IGNORE_NEW_LINES));
    		$rows = json_decode(utf8_encode($lines[0]));
    		foreach ($rows as $r) {
    			\App\Provincia::create([
    				'id' => $r->id,
    				'nombre' => $r->name
    			]);
    		}
    	}
    }
}
