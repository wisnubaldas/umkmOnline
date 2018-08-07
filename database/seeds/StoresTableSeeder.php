<?php

use Illuminate\Database\Seeder;
use App\Store;
use App\Address;
use App\StoreBank;

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
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        		'slug' => 'adityar-shop',
        		'user_id' => 3,
                'is_active' => 1,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        	[
        		'id' => 2,
        		'name' => 'Rohaeti Shop',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        		'slug' => 'rohaeti-shop',
        		'user_id' => 4,
                'is_active' => 1,
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        ]);

        Address::insert([
             [
                'store_id' => 1,
                'phone' => '085228761234',
                'address' => 'Blok A RT 04 RW 01 Desa Rajagaluhlor Kecamatan Rajagaluh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45472'
            ],

             [
                'store_id' => 2,
                'phone' => '085228761234',
                'address' => 'Blok A RT 04 RW 01 Desa Rajagaluhlor Kecamatan Rajagaluh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45472'
            ]
        ]);

        StoreBank::insert([
            [
                'store_id' => 1,
                'bank_name' => 'BRI',
                'bank_account' => '000122234445',
                'under_the_name' => 'Adityar Shop',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'store_id' => 2,
                'bank_name' => 'BCA',
                'bank_account' => '333345555677778',
                'under_the_name' => 'Rohaeti Shop',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
