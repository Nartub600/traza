<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarTrazasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarTrazas()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas');

        $response
            ->assertSuccessful()
            ->assertViewHas('trazas');
    }
}
