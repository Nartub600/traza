<?php

namespace Tests\Feature;

use App\Autopart;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearAutopartesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearAutopartes()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');

        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $product = Product::inRandomOrder()->first();

        $data = [
            'product_id'  => $product->id,
            'name'        => $this->faker->sentence,
            'description' => $this->faker->bs,
            'brand'       => $this->faker->company,
            'model'       => $this->faker->word,
            'origin'      => $this->faker->country,
            'picture'     => $this->faker->imageUrl,
        ];

        $response = $this
            ->actingAs($administrador)
            ->json('post', '/autopartes', $data);

        $response->assertSuccessful();

        $autopart = Autopart::find($response->original['id']);

        $this->assertNotNull($autopart);

        $this->assertEquals($autopart->product_id, $data['product_id']);
        $this->assertEquals($autopart->name, $data['name']);
        $this->assertEquals($autopart->description, $data['description']);
        $this->assertEquals($autopart->brand, $data['brand']);
        $this->assertEquals($autopart->model, $data['model']);
        $this->assertEquals($autopart->origin, $data['origin']);
        $this->assertEquals($autopart->picture, $data['picture']);
    }
}
