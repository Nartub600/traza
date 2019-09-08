<?php

namespace Tests\Feature;

use App\Autopart;
use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearCertificadosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearCertificados()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $autoparts = factory(Autopart::class, 5)
            ->make()
            ->toArray();

        $data = [
            'number'    => $this->faker->randomNumber,
            'cuit'      => $this->faker->regexify('[0-9]{2}-[0-9]{6,8}-[0-9]'),
            'autoparts' => $autoparts
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/certificados/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/certificados', $data);

        $response->assertRedirect('/certificados');

        $certificate = Certificate::where('number', $data['number'])->first();

        $this->assertNotNull($certificate);

        $this->assertEquals($certificate->number, $data['number']);
        $this->assertEquals($certificate->cuit, $data['cuit']);
        $this->assertCount(5, $certificate->autoparts);
    }

    /** @test */
    public function fabricanteNoPuedeCrearCertificados()
    {
        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/certificados/crear');

        $response->assertStatus(403);
    }
}
