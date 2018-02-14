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
        
      	$this->call(AnggotaTableSeeder::class);
        $this->call(BarangTableSeeder::class);
    }
}
