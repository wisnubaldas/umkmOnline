<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Address;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        	[
        		'id' => 1,
        		'name' => 'Root',
        		'email' => 'yudimashudi7@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 1,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 2,
        		'name' => 'Yudi Mashudi',
        		'email' => 'yudimashudi8@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 2,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 3,
        		'name' => 'Adityar Praja',
        		'email' => 'adityar@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 3,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 4,
        		'name' => 'Eti Rohaeti',
        		'email' => 'etiroh@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 3,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 5,
        		'name' => 'Yoga Saprida',
        		'email' => 'yogasaprida@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 3,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        ]);

        Address::insert([
            [
                'user_id' => 1,
                'phone' => '085228761234',
                'address' => 'Blok Hegarmanah RT 04 RW 05 Desa Pasindangan Kecamatan Jatitujuh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45456'
            ],

            [
                'user_id' => 2,
                'phone' => '085228761234',
                'address' => 'Blok Hegarmanah RT 04 RW 05 Desa Pasindangan Kecamatan Jatitujuh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45456'
            ],

            [
                'user_id' => 3,
                'phone' => '085228761234',
                'address' => 'Blok Hegarmanah RT 04 RW 05 Desa Pasindangan Kecamatan Jatitujuh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45456'
            ],

            [
                'user_id' => 4,
                'phone' => '085228761234',
                'address' => 'Blok Hegarmanah RT 04 RW 05 Desa Pasindangan Kecamatan Jatitujuh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45456'
            ],

            [
                'user_id' => 5,
                'phone' => '085228761234',
                'address' => 'Blok Hegarmanah RT 04 RW 05 Desa Pasindangan Kecamatan Jatitujuh',
                'city_id' => 252,
                'province_id' => 9,
                'postal_code' => '45456'
            ]
        ]);
    }
}
