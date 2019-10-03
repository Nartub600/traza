<?php

namespace Tests\Feature;

use App\NCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditarNCMTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeEditarNCM()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $ncm = NCM::create([
            'category' => $this->faker->randomNumber,
            'description' => $this->faker->sentence,
            'active' => $this->faker->boolean,
        ]);

        $response = $this
            ->actingAs($administrador)
            ->get('/ncm/' . $ncm->id . '/editar');

        $response->assertSuccessful();

        $data = [
            'category' => $this->faker->randomNumber,
            'description' => $this->faker->sentence,
            'active' => $this->faker->boolean,
        ];

        $response = $this
            ->actingAs($administrador)
            ->put('/ncm/' . $ncm->id, $data);

        $response->assertRedirect('/ncm');

        $ncm = NCM::find($ncm->id);

        $this->assertEquals($ncm->category, $data['category']);
        $this->assertEquals($ncm->description, $data['description']);
        $this->assertEquals($ncm->active, $data['active']);
    }
}
