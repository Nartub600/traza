<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerUsuariosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeVerUsuarios()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $user = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/usuarios/' . $user->id);

        $response
            ->assertSuccessful()
            ->assertViewHas('user');
    }
}
