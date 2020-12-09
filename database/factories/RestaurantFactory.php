<?php

use Faker\Generator as Faker;

$factory->define(App\Restaurant::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'address'=> $faker->address,
        'contact' => rand(100000000, 99999999)
    ];
});
