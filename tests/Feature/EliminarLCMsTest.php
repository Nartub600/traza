<?php

namespace Tests\Feature;

use App\LCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarLCMsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeEliminarLCMs()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $lcm = factory(LCM::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->delete('/lcms/' . $lcm->id);

        $response->assertRedirect('/lcms');

        $lcm = LCM::onlyTrashed()->find($lcm->id);

        $this->assertNotNull($lcm);
    }
}
