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

        $parent = factory(Product::class)->state('active')->create();

        $data = [
            'name'      => $this->faker->name,
            'active'    => $this->faker->boolean,
            'parent_id' => $parent->id,
        ];

        $response = $this
            ->actingAs($administrador)
            ->get('/productos/crear');

        $response->assertSuccessful();

        $response = $this
            ->actingAs($administrador)
            ->post('/productos', $data);

        $product = Product::where('name', $data['name'])->first();

        $this->assertNotNull($product);
        $this->assertEquals($product->active, $data['active']);
        $this->assertEquals($product->parent->id, $parent->id);
    }

    /** @test */
    public function noAdministradorNoPuedeCrearProductos()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/productos/crear');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/productos/crear');

        $response->assertStatus(403);
    }
}
