<?php

namespace Tests\Feature;

use App\Autopart;
use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditarCertificadosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeEditarCertificados()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $certificate = factory(Certificate::class)->create();
        $certificate->autoparts()->saveMany(factory(Autopart::class, 5));

        $autoparts = factory(Autopart::class, 3)
            ->make()
            ->map(function ($autoparte) { return json_encode($autoparte); })
            ->toArray();

        $data = [
            'number'    => $this->faker->randomNumber,
            'cuit'      => $this->faker->regexify('[0-9]{2}-[0-9]{6,8}-[0-9]'),
            'autoparts' => $autoparts
        ];

        $response = $this
            ->actingAs($administrador)
            ->put('/certificados/' . $certificate->id, $data);

        $response->assertRedirect('/certificados');

        $certificate = Certificate::where('number', $data['number'])->first();

        $this->assertNotNull($certificate);

        $this->assertEquals($certificate->number, $data['number']);
        $this->assertEquals($certificate->cuit, $data['cuit']);
        $this->assertCount(3, $certificate->autoparts);
    }
}
