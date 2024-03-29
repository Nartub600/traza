<?php

use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'name' => $faker->word,
        'active' => $faker->boolean,
    ];
});

$factory->state(Product::class, 'active', [
    'active' => true
]);
