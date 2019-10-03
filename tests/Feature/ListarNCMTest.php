<?php

namespace Tests\Feature;

use App\NCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarNCMTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarNCM()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/ncm');

        $ncm = NCM::all();

        $response
            ->assertSuccessful()
            ->assertViewHas('ncm', $ncm);
    }
}
