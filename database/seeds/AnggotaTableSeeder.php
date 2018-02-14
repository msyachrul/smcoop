<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
 
        foreach (range(1, 20) as $loop) {
            DB::table('anggotas')->insert([
                'noAnggota'      => $faker->ean13,
                'nama'       => $faker->name,
                'departemen' => 'Accounting',
                'posisi'    => $faker->jobTitle,
                'totalSimpanan' => $faker->randomNumber(6),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
