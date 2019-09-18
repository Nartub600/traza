<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearTrazasTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearTrazas()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas/crear');

        $response->assertSuccessful();

        $data = [
            'number' => $this->faker->phoneNumber
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/trazas', $data);

        $response->assertRedirect('/trazas');
    }
}
