<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CrearProductosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearProductos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $data = [
            'name'    => $this->faker->name,
            'family'  => $this->faker->word,
            'active'  => $this->faker->boolean
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/productos', $data);

        $product = Product::where('name', $data['name'])->first();

        $this->assertNotNull($product);

        $this->assertEquals($product->family, $data['family']);
        $this->assertEquals($product->active, $data['active']);
    }
}
