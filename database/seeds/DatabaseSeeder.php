<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        $this->call(ServiceGroupSeeder::class);
        $this->call(ServiceGroupMapSeeder::class);
    }
}
