<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarGruposTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarGrupos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        factory(Group::class, 3)->create([]);

        $response = $this
            ->actingAs($administrador)
            ->get('/grupos');

        $groups = Group::withCount('users')->get();

        $response
            ->assertSuccessful()
            ->assertViewHas('groups', $groups);
    }

    /** @test */
    public function noAdministradorNoPuedeListarGrupos()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/grupos');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/grupos');

        $response->assertStatus(403);
    }
}
