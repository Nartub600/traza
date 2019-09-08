<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearGruposTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearGrupos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $users = factory(User::class, 3)->create()->map->id->toArray();

        $data = [
            'name' => $this->faker->name,
            'active' => $this->faker->boolean,
            'users' => $users
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/grupos/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/grupos', $data);

        $response->assertRedirect('/grupos');

        $group = Group::where('name', $data['name'])->first();

        $this->assertNotNull($group);

        $this->assertEquals($group->active, $data['active']);

        $this->assertNotNull($group->users()->find($data['users'][0]));
        $this->assertNotNull($group->users()->find($data['users'][1]));
        $this->assertNotNull($group->users()->find($data['users'][2]));
        $this->assertCount(3, $group->users);
    }

    /** @test */
    public function noAdministradorNoPuedeCrearGrupos()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/grupos/crear');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/grupos/crear');

        $response->assertStatus(403);
    }
}
