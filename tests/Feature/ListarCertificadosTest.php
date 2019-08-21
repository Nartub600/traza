<?php

namespace Tests\Feature;

use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarCertificadosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarCertificados()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/certificados');

        $certificates = Certificate::all();

        $response
            ->assertSuccessful()
            ->assertViewHas('certificates', $certificates);
    }
}
