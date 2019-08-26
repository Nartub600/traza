<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarProductosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeEliminarProductos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $product = factory(Product::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->delete('/productos/' . $product->id);

        $response->assertRedirect('/productos');

        $product = Product::onlyTrashed()->find($product->id);

        $this->assertNotNull($product);
    }
}
