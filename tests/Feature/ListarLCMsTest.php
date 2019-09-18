<?php

namespace Tests\Feature;

use App\LCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarLCMsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarLCMs()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/lcms');

        $lcms = LCM::all();

        $response
            ->assertSuccessful()
            ->assertViewHas('lcms', $lcms);
    }
}
