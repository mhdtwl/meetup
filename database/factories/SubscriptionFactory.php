<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;


$factory->define(Subscription::class, function (Faker $faker) {
    $groupIds = App\Group::pluck('id')->toArray();
    $userIds = App\User::pluck('id')->toArray();

    $gId = $faker->randomElement($groupIds);
    $uId = $faker->randomElement($userIds);

    return [
        'group_id' => $gId,
        'user_id' =>   $uId,
        'invited_by_id' =>  $faker->randomElement($userIds),
        'status' =>  $faker->randomElement(Subscription::STATUS_LIST),
    ];
});
