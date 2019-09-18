<?php

namespace Tests\Feature;

use App\LCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerLCMsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeVerLCMs()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $lcm = factory(LCM::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/lcms/' . $lcm->id);

        $response
            ->assertSuccessful()
            ->assertViewHas('lcm', $lcm);
    }
}
