<?php

use Illuminate\Database\Seeder;
use App\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::insert([
        	[
        		'id' => 1,
        		'name' => 'Adityar Shop',
        		'slug' => 'adityar-shop',
        		'city_id' => 252,
        		'user_id' => 3,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 2,
        		'name' => 'Rohaeti Shop',
        		'slug' => 'rohaeti-shop',
        		'city_id' => 252,
        		'user_id' => 4,
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        ]);
    }
}
