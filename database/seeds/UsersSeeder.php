<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->state('administrador')->create([
            'username' => 'administrador',
            'active' => true
        ]);

        factory(User::class)->state('certificador')->create([
            'username' => 'certificador',
            'active' => true
        ]);

        factory(User::class)->state('fabricante')->create([
            'username' => 'fabricante',
            'active' => true
        ]);
    }
}
