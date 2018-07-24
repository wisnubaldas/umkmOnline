<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
        	[
        		'id' => 1,
        		'name' => 'Sepatu Safety Kings',
        		'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        		'price' => 180000,
                'weight' => 1500,
        		'store_id' => 1,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 2,
        		'name' => 'Tas Selempang Eiger',
        		'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        		'price' => 250000,
        		'store_id' => 1,
                'weight' => 800,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 3,
        		'name' => 'Lemari Piring',
        		'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        		'price' => 285000,
        		'store_id' => 2,
                'weight' => 3000,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 4,
        		'name' => 'Wajan Keramik',
        		'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        		'price' => 120000,
                'weight' => 500,
        		'store_id' => 2,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        ]);
    }
}
