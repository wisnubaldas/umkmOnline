<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::insert([
        	[
        		'id' => 1,
        		'name' => 'pending',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'id' => 2,
        		'name' => 'accepted',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'id' => 3,
        		'name' => 'sent',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'id' => 4,
        		'name' => 'finished',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
            [
                'id' => 5,
                'name' => 'rejected',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
