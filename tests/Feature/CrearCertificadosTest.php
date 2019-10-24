<?php

namespace Tests\Feature;

use App\Autopart;
use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CrearCertificadosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearCertificados()
    {
        Storage::fake('public');

        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $autoparts = factory(Autopart::class, 5)
            ->make()
            ->toArray();

        $data = [
            'number'    => $this->faker->randomNumber,
            'cuit'      => $this->faker->regexify('[0-9]{2}-[0-9]{6,8}-[0-9]'),
            'autoparts' => $autoparts,
            'documents' => [
                'licencia' => UploadedFile::fake()->create('licencia.pdf', 128)
            ]
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/licencias/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/licencias', $data);

        $response->assertRedirect('/licencias');

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
            ->get('/licencias/crear');

        $response->assertStatus(403);
    }
}
