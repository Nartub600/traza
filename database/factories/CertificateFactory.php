<?php

use App\Certificate;
use App\User;
use Faker\Generator as Faker;

$factory->define(Certificate::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->state('inNewGroup'),
        'number' => $faker->randomNumber,
        'cuit' => $this->faker->regexify('[0-9]{2}-[0-9]{6,8}-[0-9]')
    ];
});
