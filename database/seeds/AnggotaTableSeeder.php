<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
 
        foreach (range(1, 5) as $loop) {
            DB::table('anggotas')->insert([
                'no' => $faker->ean13,
                'pin' =>$faker->randomNumber(6,true),
                'nama' => $faker->name,
                'departemen' => 'Accounting',
                'posisi' => $faker->jobTitle,
                'totalSimpanan' => $faker->randomNumber(6),
                'admin' => false,
            ]);
        }
    }
}
