<?php

use App\Autopart;
use App\TAD;
use Faker\Generator as Faker;

$factory->define(TAD::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Solicitud del Certificación de Homologación de Autopartes y/o elementos de Seguridad', 'Solicitud del Certificado de Autoparte Primer Equipo (C.A.P.E) - Excepción CHAS', 'Solicitud de Excepción de Chas']),
        'code' => $faker->randomNumber,
        'user' => $faker->name,
        'division' => $faker->randomElement(['DNI#MP', 'DNI#MPYT']),
        'sector' => $faker->randomElement(['PVD', 'MEDNI']),
        'tag' => $faker->randomElement(['INTI y VUCE']),
        'paid' => $faker->boolean,
        'validation' => $faker->randomElement(['Ninguna']),
        'signature' => $faker->boolean,
        'auth_level' => $faker->randomElement(['AFIP3']),
        'documents' => [],
        'autoparts' => factory(Autopart::class, 5)->make()
    ];
});
