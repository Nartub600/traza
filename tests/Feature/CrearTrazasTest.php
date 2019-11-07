<?php

namespace Tests\Feature;

use App\Autopart;
use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CrearTrazasTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearTrazasCHASNacional()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas/crear/chas');

        $response->assertSuccessful();

        $certificate = factory(Certificate::class)->create();
        $certificate->autoparts()->saveMany(factory(Autopart::class, 5)->make());

        $data = [
            'type' => 'chas',
            'number' => $this->faker->phoneNumber,
            'user' => $this->faker->name,
            'division' => $this->faker->bs,
            'sector' => $this->faker->bs,
            'tag' => $this->faker->bs,
            'validation' => $this->faker->bs,
            'signature' => $this->faker->bs,
            'auth_level' => $this->faker->bs,
            'documents' => [
                'foto' => [
                    UploadedFile::fake()->image('foto1.jpg')
                ],
                'declaracion_jurada' => UploadedFile::fake()->create('declaracion.pdf'),
                'certificado' => UploadedFile::fake()->create('certificado.pdf'),
                'catalogo' => UploadedFile::fake()->create('catalogo.pdf'),
                'autopartesNacional' => UploadedFile::fake()->create('chas-nacional.xlsx'),
            ],
            'autoparts' => $certificate->autoparts->map(function ($autopart) {
                $autopart->pictures = '';
                return $autopart;
            })
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/trazas', $data);

        $response->assertRedirect('/trazas');
    }
}
