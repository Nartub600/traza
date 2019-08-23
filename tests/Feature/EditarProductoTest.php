<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditarProductoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeEditarProductos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $product = factory(Product::class)->create();

        $data = [
            'name' => $this->faker->word,
            'family' => $this->faker->word,
            'active' => $this->faker->boolean,
            'picture' => $this->faker->imageUrl
        ];

        $response = $this
            ->actingAs($administrador)
            ->put('/productos/' . $product->id, $data);

        $response->assertRedirect('/productos');

        $product = Product::find($product->id);

        $this->assertEquals($product->name, $data['name']);
        $this->assertEquals($product->family, $data['family']);
        $this->assertEquals($product->active, $data['active']);
        $this->assertEquals($product->picture, $data['picture']);
    }
}
