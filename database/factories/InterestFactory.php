<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Interest;
use Faker\Generator as Faker;

$factory->define(Interest::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['travel' ,'painting', 'hiking', 'surfing', 'reading', 'writing', 'learning' ]),
        'parent_id' => null,
    ];
});
