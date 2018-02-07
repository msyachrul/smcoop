<?php

use Faker\Generator as Faker;

$factory->define(App\Anggota::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'departemen' => $faker->name,
    ];
});
