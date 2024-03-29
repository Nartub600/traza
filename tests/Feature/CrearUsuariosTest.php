<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Role;
use Tests\TestCase;

class CrearUsuariosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearUsuarios()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $roles = Role::all()->map->id->random(2)->toArray();
        $groups = factory(Group::class, 3)->create()->map->id->random(2)->toArray();
        $password = $this->faker->password;

        $data = [
            'name'                  => $this->faker->name,
            'email'                 => $this->faker->email,
            'username'              => $this->faker->userName,
            'password'              => $password,
            'password_confirmation' => $password,
            'active'                => $this->faker->boolean,
            'roles'                 => $roles,
            'groups'                => $groups,
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/usuarios/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/usuarios', $data);

        $response->assertRedirect('/usuarios');

        $user = User::where('email', $data['email'])->first();

        $this->assertNotNull($user);

        $this->assertEquals($user->name, $data['name']);
        $this->assertEquals($user->username, $data['username']);
        $this->assertTrue(Hash::check($data['password'], $user->password));
        $this->assertEquals($user->active, $data['active']);

        $this->assertNotNull($user->groups()->find($data['groups'][0]));
        $this->assertNotNull($user->groups()->find($data['groups'][1]));
        $this->assertCount(2, $user->groups);

        $this->assertTrue($user->hasRole($data['roles'][0]));
        $this->assertTrue($user->hasRole($data['roles'][1]));
        $this->assertCount(2, $user->roles);
    }

    /** @test */
    public function noAdministradorNoPuedeCrearUsuarios()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/usuarios/crear');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/usuarios/crear');

        $response->assertStatus(403);
    }
}
