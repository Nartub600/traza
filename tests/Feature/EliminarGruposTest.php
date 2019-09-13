<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarGruposTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeEliminarGrupos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $group = factory(Group::class)->create();
        $users = factory(User::class, 5)->create();

        $users->each(function ($user) use ($group) {
            $user->groups()->attach($group->id);
        });

        $this->assertCount(1, $users[0]->groups()->get());
        $this->assertCount(1, $users[1]->groups()->get());
        $this->assertCount(1, $users[2]->groups()->get());
        $this->assertCount(1, $users[3]->groups()->get());
        $this->assertCount(1, $users[4]->groups()->get());

        $response = $this
            ->actingAs($administrador)
            ->delete('/grupos/' . $group->id);

        $response->assertRedirect('/grupos');

        $group = Group::onlyTrashed()->find($group->id);

        $this->assertNotNull($group);
        $this->assertCount(0, $users[0]->groups()->get());
        $this->assertCount(0, $users[1]->groups()->get());
        $this->assertCount(0, $users[2]->groups()->get());
        $this->assertCount(0, $users[3]->groups()->get());
        $this->assertCount(0, $users[4]->groups()->get());
    }
}
