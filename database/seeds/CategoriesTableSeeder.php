<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
        	[
        		'id' => 1,
        		'name' => 'Fashion Wanita',
        		'slug' => 'fashion-wanita',
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 2,
        		'name' => 'Fashion Pria',
        		'slug' => 'fashion-pria',
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 3,
        		'name' => 'Fashion Anak',
        		'slug' => 'fashion-anak',
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 4,
        		'name' => 'Kecantikan',
        		'slug' => 'kecantikan',
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 5,
        		'name' => 'Rumah Tangga',
        		'slug' => 'rumah-tangga',
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 6,
        		'name' => 'Makanan dan Minuman',
        		'slug' => 'makanan-dan-minuman',
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 7,
        		'name' => 'Buku',
        		'slug' => 'buku',
        		'created_at' => now(),
        		'updated_at' => now()
        	]
        ]);
    }
}
