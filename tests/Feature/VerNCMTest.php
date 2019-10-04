<?php

namespace Tests\Feature;

use App\NCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerNCMTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeVerNCM()
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
            ->get('/ncm/' . $ncm->id);

        $response
            ->assertSuccessful()
            ->assertViewHas('ncm', $ncm);
    }
}
