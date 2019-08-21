<?php

use App\Autopart;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Autopart::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->first()->id,
        'name' => $faker->sentence,
        'description' => $faker->bs,
        'brand' => $faker->company,
        'model' => $faker->word,
        'origin' => $faker->country,
        'picture' => $faker->imageUrl,
    ];
});
