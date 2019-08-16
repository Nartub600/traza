<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearGruposTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearGrupos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $data = [
            'name' => $this->faker->name,
            'active' => $this->faker->boolean
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/grupos', $data);

        $response->assertSuccessful();

        $group = Group::where('name', $data['name'])->first();

        $this->assertNotNull($group);
    }
}
