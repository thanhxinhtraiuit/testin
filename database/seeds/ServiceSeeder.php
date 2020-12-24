<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20 ; $i++) { 
            DB::table('services')->insert([
                'service_name' => 'service'.str_random(10),          
            ]);
        }
    }
}
