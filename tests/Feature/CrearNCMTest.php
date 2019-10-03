<?php

namespace Tests\Feature;

use App\NCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearNCMTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearNCM()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/ncm/crear');

        $response->assertSuccessful();

        $data = [
            'category' => $this->faker->randomNumber,
            'description' => $this->faker->sentence,
            'active' => $this->faker->boolean,
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/ncm', $data);

        $response->assertRedirect('/ncm');

        $ncm = NCM::where('category', $data['category'])->first();

        $this->assertNotNull($ncm);
        $this->assertEquals($ncm->description, $data['description']);
        $this->assertEquals($ncm->active, $data['active']);
    }
}
