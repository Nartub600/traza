<?php

namespace Tests\Feature;

use App\Autopart;
use App\Certificate;
use App\LCM;
use App\Product;
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
        $autoparts = collect($certificate->autoparts()->saveMany(factory(Autopart::class, 5)->make()));
        $excelAutoparts = $certificate->autoparts->map(function ($autopart) {
            $autopart['pictures'] = '';
            return $autopart;
        });

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
            'autoparts' => $excelAutoparts
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/trazas', $data);

        $response->assertRedirect('/trazas');

        $certificate->refresh();

        $this->assertNotNull($certificate->autoparts[0]->chas);
        $this->assertNotNull($certificate->autoparts[1]->chas);
        $this->assertNotNull($certificate->autoparts[2]->chas);
        $this->assertNotNull($certificate->autoparts[3]->chas);
        $this->assertNotNull($certificate->autoparts[4]->chas);
    }

    /** @test */
    public function administradorPuedeCrearTrazasCHASExtranjero()
    {
        $this->withoutExceptionHandling();

        // visitar la página
        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas/crear/chas');

        $response->assertSuccessful();

        // voy a enviar cinco autopartes que no existen
        $autoparts = collect(factory(Autopart::class, 5)->make()->toArray());
        $excelAutoparts = $autoparts->map(function ($autopart) {
            $autopart['pictures'] = '';
            $autopart['product'] = $autopart['product']['category'];
            $autopart['ncm'] = $autopart['ncm']['category'];
            $autopart['family'] = '';
            return $autopart;
        });

        $nonExistentAutoparts = $autoparts->map(function ($autopart) {
            return Autopart::where('brand', $autopart['brand'])
                ->where('model', $autopart['model'])
                ->where('origin', $autopart['origin'])
                ->whereNull('chas')
                ->first();
        });

        $this->assertNull($nonExistentAutoparts[0]);
        $this->assertNull($nonExistentAutoparts[1]);
        $this->assertNull($nonExistentAutoparts[2]);
        $this->assertNull($nonExistentAutoparts[3]);
        $this->assertNull($nonExistentAutoparts[4]);

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
                'wp29' => UploadedFile::fake()->create('wp29.pdf'),
                'catalogo' => UploadedFile::fake()->create('catalogo.pdf'),
                'autopartesExtranjera' => UploadedFile::fake()->create('chas-extranjera.xlsx'),
            ],
            'autoparts' => $excelAutoparts
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/trazas', $data);

        $response->assertRedirect('/trazas');

        // verifico que existan luego de enviar el formulario
        $foundAutoparts = $autoparts->map(function ($autopart) {
            return Autopart::where('brand', $autopart['brand'])
                ->where('model', $autopart['model'])
                ->where('origin', $autopart['origin'])
                ->whereNull('chas')
                ->first();
        });

        $this->assertNotNull($foundAutoparts[0]);
        $this->assertNotNull($foundAutoparts[1]);
        $this->assertNotNull($foundAutoparts[2]);
        $this->assertNotNull($foundAutoparts[3]);
        $this->assertNotNull($foundAutoparts[4]);

        $traza = $foundAutoparts[0]->traza;

        // apruebo el trámite
        $response = $this
            ->actingAs($administrador)
            ->patch("/trazas/{$traza->id}/aprobar", [
                'autoparts' => $excelAutoparts
            ]);

        $foundAutoparts->each->refresh();

        $this->assertNotNull($foundAutoparts[0]->chas);
        $this->assertNotNull($foundAutoparts[1]->chas);
        $this->assertNotNull($foundAutoparts[2]->chas);
        $this->assertNotNull($foundAutoparts[3]->chas);
        $this->assertNotNull($foundAutoparts[4]->chas);
    }

    /** @test */
    public function administradorPuedeCrearTrazasCAPE()
    {
        $this->withoutExceptionHandling();

        // visitar la página
        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas/crear/cape');

        $response->assertSuccessful();

        $lcms = collect(factory(LCM::class, 5)->create()->toArray());
        $excelLcms = $lcms->map(function ($lcm) {
            $lcm['lcm'] = $lcm['number'];
            $lcm['product'] = explode('.', Product::inRandomOrder()->first()->category)[0];
            $lcm['pictures'] = '';
            return $lcm;
        });

        $data = [
            'type' => 'cape',
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
                'solicitud_cape' => UploadedFile::fake()->create('solicitud.pdf'),
                'lcms' => UploadedFile::fake()->create('lcms.xlsx'),
            ],
            'lcms' => $excelLcms
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/trazas', $data);

        $response->assertRedirect('/trazas');

        $lcms = collect($excelLcms)->map(function ($lcm) {
            return LCM::where('number', $lcm['lcm'])
                ->where('brand', $lcm['brand'])
                ->where('model', $lcm['model'])
                ->where('country', $lcm['country'])
                ->first();
        });

        $this->assertNotNull($lcms[0]->cape);
        $this->assertNotNull($lcms[1]->cape);
        $this->assertNotNull($lcms[2]->cape);
        $this->assertNotNull($lcms[3]->cape);
        $this->assertNotNull($lcms[4]->cape);
    }

    /** @test */
    public function administradorPuedeCrearTrazasExcepcionCHAS()
    {
        // $this->withoutExceptionHandling();

        // visitar la página
        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/trazas/crear/excepcion-chas');

        $response->assertSuccessful();

        $autoparts = collect(factory(Autopart::class, 5)->make()->toArray());

        $excelAutoparts = $autoparts->map(function ($autopart) {
            $autopart['pictures'] = '';
            $autopart['product'] = $autopart['product']['category'];
            $autopart['ncm'] = $autopart['ncm']['category'];
            $autopart['family'] = '';
            return $autopart;
        });

        $data = [
            'type' => 'excepcion-chas',
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
                'excepcion_chas' => UploadedFile::fake()->create('excepcion.pdf'),
                'autopartesExcepcion' => UploadedFile::fake()->create('excepcion-chas.xlsx'),
            ],
            'autoparts' => $excelAutoparts
        ];

        $response = $this
            ->actingAs($administrador)
            ->json('post', '/trazas', $data);

        $response->assertRedirect('/trazas');

        $autoparts = collect($excelAutoparts)->map(function ($autopart) {
            return Autopart::where('brand', $autopart['brand'])
                ->where('model', $autopart['model'])
                ->where('origin', $autopart['origin'])
                ->first();
        });

        $this->assertNotNull($autoparts[0]->chas);
        $this->assertNotNull($autoparts[1]->chas);
        $this->assertNotNull($autoparts[2]->chas);
        $this->assertNotNull($autoparts[3]->chas);
        $this->assertNotNull($autoparts[4]->chas);
    }
}
