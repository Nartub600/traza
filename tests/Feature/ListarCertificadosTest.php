<?php

namespace Tests\Feature;

use App\Certificate;
use App\Group;
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

    /** @test */
    public function certificadorPuedeListarCertificadosDeSusGruposSolamente()
    {
        $this->withoutExceptionHandling();

        $certificador = factory(User::class)->state('certificador')->create();
        $group = factory(Group::class)->create();
        $certificador->groups()->attach($group);

        factory(Certificate::class, 10)->create();
        $own = factory(Certificate::class, 5)->create([
            'user_id' => $certificador->id
        ]);

        $response = $this
            ->actingAs($certificador)
            ->get('/certificados');

        $certificates = Certificate::fromUserGroups($certificador)->pluck('id');

        $response
            ->assertSuccessful()
            ->assertViewHas('certificates');

        $this->assertCount(5, $certificates);
        $this->assertContains($own[0]->id, $certificates);
        $this->assertContains($own[1]->id, $certificates);
        $this->assertContains($own[2]->id, $certificates);
        $this->assertContains($own[3]->id, $certificates);
        $this->assertContains($own[4]->id, $certificates);
    }

    /** @test */
    public function fabricanteNoPuedeListarCertificados()
    {
        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/certificados');

        $response->assertStatus(403);
    }
}
