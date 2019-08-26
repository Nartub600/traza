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

        $response = $this
            ->actingAs($administrador)
            ->delete('/grupos/' . $group->id);

        $response->assertRedirect('/grupos');

        $group = Group::onlyTrashed()->find($group->id);

        $this->assertNotNull($group);
    }
}
