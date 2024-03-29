<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditarGruposTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeEditarGrupos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $group = factory(Group::class)->create();

        $users = factory(User::class, 3)->create()->map->id->toArray();

        $data = [
            'name' => $this->faker->name,
            'active' => $this->faker->boolean,
            'users' => $users
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/grupos/' . $group->id . '/editar');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->put('/grupos/' . $group->id, $data);

        $response->assertRedirect('/grupos');

        $group = Group::find($group->id);

        $this->assertEquals($group->name, $data['name']);
        $this->assertEquals($group->active, $data['active']);

        $this->assertNotNull($group->users()->find($data['users'][0]));
        $this->assertNotNull($group->users()->find($data['users'][1]));
        $this->assertNotNull($group->users()->find($data['users'][2]));
        $this->assertCount(3, $group->users);
    }

    /** @test */
    public function noAdministradorNoPuedeEditarGrupos()
    {
        $group = factory(Group::class)->create();

        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/grupos/' . $group->id . '/editar');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/grupos/' . $group->id . '/editar');

        $response->assertStatus(403);
    }
}
