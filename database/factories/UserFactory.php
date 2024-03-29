<?php

use App\Group;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'username' => $faker->userName,
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'active' => $faker->boolean
    ];
});

$factory->afterCreatingState(User::class, 'inNewGroup', function ($user) {
    $group = factory(Group::class)->create();
    $user->groups()->attach($group);
});

$factory->afterCreatingState(User::class, 'administrador', function ($user) {
    $user->assignRole('administrador');
});

$factory->afterCreatingState(User::class, 'certificador', function ($user) {
    $user->assignRole('certificador');
});

$factory->afterCreatingState(User::class, 'fabricante', function ($user) {
    $user->assignRole('fabricante');
});
