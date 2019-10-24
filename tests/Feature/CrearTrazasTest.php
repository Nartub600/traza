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
    public function administradorPuedeCrearTrazasCHAS()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas/crear/chas');

        $response->assertSuccessful();

        $data = [
            'type' => 'chas',
            'number' => $this->faker->phoneNumber,
            'user' => $this->faker->name,
            'division' => $this->faker->bs,
            'sector' => $this->faker->bs,
            'tag' => $this->faker->bs,
            'validation' => $this->faker->bs,
            'signature' => $this->faker->bs,
            'auth_level' => $this->faker->bs,
            'documents' => []
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/trazas', $data);

        $response->assertRedirect('/trazas');
    }
}
