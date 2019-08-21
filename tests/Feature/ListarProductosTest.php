<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarProductosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarProductos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/productos');

        $products = Product::all();

        $response
            ->assertSuccessful()
            ->assertViewHas('products', $products);
    }
}
