<?php

use Illuminate\Database\Seeder;

class ServiceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20 ; $i++) { 
            DB::table('service_group')->insert([
                'service_group_name' => 'service_group'.str_random(10),          
                'service_group_parent' => rand(1,13),   
            ]);
        }
    }
}
