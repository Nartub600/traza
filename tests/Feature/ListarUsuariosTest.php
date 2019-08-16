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

        $response
            ->assertSuccessful()
            ->assertViewHas('users');
    }
}
