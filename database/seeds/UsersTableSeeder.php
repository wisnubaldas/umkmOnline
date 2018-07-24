<?php

use Illuminate\Database\Seeder;
use App\User;

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
        		'email' => 'admin@root.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 1,
                'city_id' => 252,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 2,
        		'name' => 'Yudi Mashudi',
        		'email' => 'yudimashudi@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 2,
                'city_id' => 252,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 3,
        		'name' => 'Adityar Praja',
        		'email' => 'adityar@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 3,
                'city_id' => 252,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 4,
        		'name' => 'Eti Rohaeti',
        		'email' => 'etiroh@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 3,
                'city_id' => 252,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        	[
        		'id' => 5,
        		'name' => 'Yogi Gilang Ramadhan',
        		'email' => 'yogigilang182@gmail.com',
        		'password' => bcrypt('rahasia'),
        		'role_id' => 3,
                'city_id' => 252,
        		'created_at' => now(),
        		'updated_at' =>now()
        	],
        ]);
    }
}
