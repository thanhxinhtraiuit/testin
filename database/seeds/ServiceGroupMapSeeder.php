<?php

use Illuminate\Database\Seeder;

class ServiceGroupMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 40 ; $i++) { 
            DB::table('service_group_map')->insert([
                'service_id' => rand(1,20),        
                'service_group_id' => rand(1,20),     
            ]);
        }
    }
}
