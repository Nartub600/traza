<?php

namespace Tests\Feature;

use App\LCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearLCMsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearLCMs()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $data = [
            'gde'       => $this->faker->word,
            'special'   => $this->faker->word,
            'reference' => $this->faker->word,
            'type'      => $this->faker->word,
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/lcms/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/lcms', $data);

        $response->assertRedirect('/lcms');

        $lcm = LCM::where('gde', $data['gde'])->first();

        $this->assertNotNull($lcm);
        $this->assertEquals($lcm->gde, $data['gde']);
        $this->assertEquals($lcm->special, $data['special']);
        $this->assertEquals($lcm->reference, $data['reference']);
        $this->assertEquals($lcm->type, $data['type']);
    }
}
