<?php

use App\LCM;
use App\User;
use Faker\Generator as Faker;

$factory->define(LCM::class, function (Faker $faker) {
    return [
        'user_id'             => factory(User::class),
        'type'                => $faker->word,
        'defeats'             => $faker->word,
        'number'              => $faker->word,
        'issued_at'           => $faker->word,
        'business_name'       => $faker->word,
        'address'             => $faker->word,
        'cuit'                => $faker->word,
        'country'             => $faker->word,
        'manufacturing_place' => $faker->word,
        'commercial_name'     => $faker->word,
        'brand'               => $faker->word,
        'model'               => $faker->word,
        'category'            => $faker->word,
        'version'             => $faker->word,
        'pictures'            => []
    ];
});
