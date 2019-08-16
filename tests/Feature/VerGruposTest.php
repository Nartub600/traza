<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerGruposTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeVerGrupos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $group = factory(Group::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/grupos/' . $group->id);

        $response
            ->assertSuccessful()
            ->assertViewHas('group', $group);
    }
}
