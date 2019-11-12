<?php

namespace Tests\Feature;

use App\LCM;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearLCMsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearLCMs()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $data = [
            'type'                => $this->faker->word,
            'defeats'             => $this->faker->word,
            'number'              => $this->faker->word,
            'issued_at'           => $this->faker->word,
            'business_name'       => $this->faker->word,
            'address'             => $this->faker->word,
            'cuit'                => $this->faker->word,
            'origin'              => $this->faker->word,
            'manufacturing_place' => $this->faker->word,
            'commercial_name'     => $this->faker->word,
            'brand'               => $this->faker->word,
            'model'               => $this->faker->word,
            'category'            => $this->faker->word,
            'version'             => $this->faker->word,
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/lcms/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/lcms', $data);

        $response->assertRedirect('/lcms');

        $lcm = LCM::where('number', $data['number'])->first();

        $this->assertNotNull($lcm);

        $this->assertEquals($lcm->type, $data['type']);
        $this->assertEquals($lcm->defeats, $data['defeats']);
        $this->assertEquals($lcm->issued_at, $data['issued_at']);
        $this->assertEquals($lcm->business_name, $data['business_name']);
        $this->assertEquals($lcm->address, $data['address']);
        $this->assertEquals($lcm->cuit, $data['cuit']);
        $this->assertEquals($lcm->origin, $data['origin']);
        $this->assertEquals($lcm->manufacturing_place, $data['manufacturing_place']);
        $this->assertEquals($lcm->commercial_name, $data['commercial_name']);
        $this->assertEquals($lcm->brand, $data['brand']);
        $this->assertEquals($lcm->model, $data['model']);
        $this->assertEquals($lcm->category, $data['category']);
        $this->assertEquals($lcm->version, $data['version']);
    }
}
