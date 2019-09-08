<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Role;
use Tests\TestCase;

class ListarPerfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarPerfiles()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/perfiles');

        $roles = Role::withCount('users')->get();

        $response
            ->assertSuccessful()
            ->assertViewHas('roles', $roles);
    }

    /** @test */
    public function noAdministradorNoPuedeListarPerfiles()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/perfiles');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/perfiles');

        $response->assertStatus(403);
    }
}
