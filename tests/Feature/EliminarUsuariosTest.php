<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarUsuariosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeEliminarUsuarios()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->delete('/usuarios/' . $user->id);

        $response->assertRedirect('/usuarios');

        $user = User::onlyTrashed()->find($user->id);

        $this->assertNotNull($user);
    }
}
