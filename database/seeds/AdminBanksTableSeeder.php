<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_banks')->insert([
        	[
        		'bank_name' => 'BRI',
        		'bank_account' => '32100567849',
        		'under_the_name' => 'UMKM ONLINE',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'bank_name' => 'BCA',
                'bank_account' => '32100567848',
                'under_the_name' => 'UMKM ONLINE',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'bank_name' => 'MANDIRI',
                'bank_account' => '32100567847',
                'under_the_name' => 'UMKM ONLINE',
        		'created_at' => now(),
        		'updated_at' => now()
        	]
        ]);
    }
}
