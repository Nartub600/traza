<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarUsuariosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarUsuarios()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        factory(User::class, 3)->state('administrador')->create();
        factory(User::class, 3)->state('certificador')->create();
        factory(User::class, 3)->state('fabricante')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/usuarios');

        $users = User::with(['groups', 'roles'])->get();

        $response
            ->assertSuccessful()
            ->assertViewHas('users', $users);
    }

    /** @test */
    public function noAdministradorNoPuedeListarGrupos()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/usuarios');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/usuarios');

        $response->assertStatus(403);
    }
}
