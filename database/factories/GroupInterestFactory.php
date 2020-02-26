<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GroupInterest;
use Faker\Generator as Faker;

$factory->define(GroupInterest::class, function (Faker $faker) {
    $groupIds = App\Group::pluck('id')->toArray();
    $interestIds = App\Interest::pluck('id')->toArray();
    return [
        'group_id' => $faker->randomElement($groupIds),
        'interest_id' =>   $faker->randomElement($interestIds),
    ];
});
