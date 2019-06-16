<?php

use Illuminate\Database\Seeder;

class PoblacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if (is_readable(storage_path('app/public/populations.json'))) {
    		$lines = file(storage_path('app/public/populations.json', FILE_IGNORE_NEW_LINES));
    		$rows = json_decode(utf8_encode($lines[0]));
            $count = 0;
            foreach ($rows as $index => $r) {
                $isset_in_bd = \App\Poblacion::where('nombre', $r->name)->get();
                if ($isset_in_bd->count()) continue;
                \App\Poblacion::create([
                    'id' => $r->id,
                    'provincia_id' => $r->provincia_id,
                    'nombre' => $r->name
                ]);
                if ($count == 500) return;
                $count++;
            }
        }
    }
}
