<?php

namespace Tests\Feature;

use App\LCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditarLCMsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeEditarLCMs()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $lcm = factory(LCM::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/lcms/' . $lcm->id . '/editar');

        $response->assertSuccessful();

        $data = [
            'gde'       => $this->faker->word,
            'special'   => $this->faker->word,
            'reference' => $this->faker->word,
            'type'      => $this->faker->word,
        ];

        $response = $this
            ->actingAs($administrador)
            ->put('/lcms/' . $lcm->id, $data);

        $response->assertRedirect('/lcms');

        $lcm = LCM::find($lcm->id);

        $this->assertNotNull($lcm);
        $this->assertEquals($lcm->gde, $data['gde']);
        $this->assertEquals($lcm->special, $data['special']);
        $this->assertEquals($lcm->reference, $data['reference']);
        $this->assertEquals($lcm->type, $data['type']);
    }
}
