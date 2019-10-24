<?php

namespace Tests\Feature;

use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarCertificadosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeEliminarUsuarios()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $certificate = factory(Certificate::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->delete('/licencias/' . $certificate->id);

        $response->assertRedirect('/licencias');

        $certificate = Certificate::onlyTrashed()->find($certificate->id);

        $this->assertNotNull($certificate);
    }
}
