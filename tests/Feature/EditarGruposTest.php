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
            ->put('/grupos/' . $group->id, $data);

        $response->assertStatus(302);

        $group = Group::find($group->id);

        $this->assertEquals($group->name, $data['name']);
        $this->assertEquals($group->active, $data['active']);

        $this->assertNotNull($group->users()->find($data['users'][0]));
        $this->assertNotNull($group->users()->find($data['users'][1]));
        $this->assertNotNull($group->users()->find($data['users'][2]));
        $this->assertCount(3, $group->users);
    }
}
