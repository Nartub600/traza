<?php

use App\Autopart;
use App\Certificate;
use App\NCM;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Autopart::class, function (Faker $faker) {
    return [
        // 'certificate_id' => factory(Certificate::class),
        'family_id' => Product::inRandomOrder()->first()->id,
        'product_id' => Product::inRandomOrder()->first()->id,
        'ncm_id' => NCM::inRandomOrder()->first()->id,
        'description' => $faker->bs,
        'manufacturer' => $faker->company,
        'importer' => $faker->company,
        'business_name' => $faker->company,
        'part_number' => $faker->word,
        'brand' => $faker->company,
        'model' => $faker->word,
        'origin' => $faker->country,
        'size' => $faker->word,
        'formulation' => $faker->bs,
        'application' => $faker->bs,
        'license' => $faker->word,
        'certified_at' => $faker->date,
    ];
});
