<?php

use App\LCM;
use App\User;
use Faker\Generator as Faker;

$factory->define(LCM::class, function (Faker $faker) {
    return [
        'user_id'   => factory(User::class),
        'gde'       => $faker->word,
        'special'   => $faker->word,
        'reference' => $faker->word,
        'type'      => $faker->word,
    ];
});
